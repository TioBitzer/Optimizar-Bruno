<?php

namespace App\Services;

use App\Models\Terminal;
use App\Models\Ubigeo;
use App\Models\TarifarioGrupo;
use App\Models\GrupoTarifa;

class OptimizadorService
{
    public function obtenerDatos()
    {
        $terminales = Terminal::where('ter_nombre', '!=', '...')
            ->with('ubigeo')
            ->get();

        $data = [];

        foreach ($terminales as $terminal) {
            if (!$terminal->ubigeo) continue;

            $dep_id = $terminal->ubigeo->ubi_depid;
            $prov_id = $terminal->ubigeo->ubi_provid;

            $distritos = Ubigeo::where('ubi_depid', $dep_id)
                ->where('ubi_provid', $prov_id)
                ->where('ubi_distrito', '!=', '')
                ->whereIn('ubi_distid', function ($query) use ($dep_id, $prov_id) {
                    $query->select('ta_id_distrito')
                        ->from('emp_tarifario_grupos')
                        ->where('ta_id_departamento', $dep_id)
                        ->where('ta_id_provincia', $prov_id);
                })
                ->get();

            $distritosData = [];

            foreach ($distritos as $dist) {
                $distritosData[] = [
                    'ubi_distrito' => $dist->ubi_distrito,
                    'ubi_id' => $dist->ubi_id,
                    'tarifa_recojo' => $this->traerTarifa($dist->ubi_id, 'recojo'),
                    'tarifa_reparto' => $this->traerTarifa($dist->ubi_id, 'reparto'),
                ];
            }

            $data[$terminal->ter_id] = [
                'name' => $terminal->ter_nombre,
                'distritos' => $distritosData,
            ];
        }

        return $data;
    }

    private function traerTarifa($ubi_id, $tipo)
    {
        $tarifaGrupo = TarifarioGrupo::where('ta_ubigeo', $ubi_id)->first();

        if (!$tarifaGrupo) {
            return [];
        }

        $gt_id = $tipo === 'reparto'
            ? $tarifaGrupo->ta_id_tarifa_reparto
            : $tarifaGrupo->ta_id_tarifa;

        $grupoTarifa = GrupoTarifa::find($gt_id);

        return $grupoTarifa ? json_decode($grupoTarifa->gt_tarifas, true) : [];
    }
}
