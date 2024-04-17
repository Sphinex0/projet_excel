<?php

namespace App\Imports;

use App\Models\Efp;
use App\Models\Filiere;
use App\Models\Formateur;
use App\Models\Groupe;
use App\Models\Module;
use App\Models\Presentiel;
use App\Models\Secteur;
use App\Models\SousGroupe;
use App\Models\Synch;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class multiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if EFP exists, if not, create it
        $efp = Efp::firstOrCreate(['nom' => $row['efp']]);

        // Get or create Secteur
        $secteur = Secteur::firstOrCreate([
            'nom' => $row['secteur']
        ]);
        
        // Check if Filiere exists, if not, create it
        $filiere = Filiere::firstOrCreate([
            'secteur_id'=>$secteur->id,
            'code' => $row['code_filiere'],
            'nom' => $row['filiere'],
            'niveau' => $row['niveau'],
            'type_format' => $row['type_de_formation']
        ]);

        // Attach the EFP to the Filiere if not already attached
        $efp->filieres()->syncWithoutDetaching($filiere->id);

        // Get or create Formateur
        $formateur = Formateur::firstOrCreate([
            'Mle' => $row['mle_affecte_presentiel_actif'],
            'nom' => $row['formateur_affecte_presentiel_actif'],
            'type' => $row['formateur_type'],
        ]);

        // Get or create Groupe
        $groupe = Groupe::firstOrCreate([
            'nom' => $row['groupe'],
            'creneau' => $row['creneau'],
            'année_format' => $row['annee_de_formation'],
            'mode' => $row['mode'],
        ]);

        // Get or create SousGroupe
        $sousGroupe = SousGroupe::firstOrCreate([
            'nom' => $row['sous_groupe'],
            'status' => $row['statut_sous_groupe'],
            'groupe_id' => $groupe->id, // Associate SousGroupe with Groupe
        ]);

        // Create Module and fill foreign key
        $module = Module::firstOrCreate([
            'code' => $row['code_module'],
            'nom' => $row['module'],
            'EFM_R' => $row['efm_regional'],
            'MH_G' => $row['mh_affectee_globale_p_syn'],
            'MH_G_realisé' => $row['mh_realisee_globale'],
            'achevé' => $row['module_acheve'],
            'nb_cc' => $row['nb_cc'],
            'S_efm' => $row['seance_efm'],
            'validation' => $row['validation_efm'],
            'filiere_id' => $filiere->id, // Associate Module with Filiere

        ]);

        // Get or create Presentiel
        $presentiel = Presentiel::firstOrCreate([
            'module_id'=>$module->id,
            'formateur_id'=>$formateur->id,
            'MH_P' => $row['mh_affectee_presentiel'],
            'MH_P_Realisé' => $row['mh_realisee_presentiel'],
        ]);



        // Get or create Synch
        $synch = Synch::firstOrCreate([
            'module_id'=>$module->id,
            'formateur_id'=>$formateur->id,
            'MH_S' => $row['mh_affectee_sync'],
            'MH_S_Realisé' => $row['mh_realisee_sync'],
        ]);





        // Return null as this import doesn't return a single model instance
        return null;
    }
}
