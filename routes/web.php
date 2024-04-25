<?php

use App\Http\Controllers\ImportController;
use App\Models\Efp;
use App\Models\Formateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('import');
});
Route::post('/post', [ImportController::class, "store"])->name("store");




Route::get('/efp', function () {
    $efps = Efp::with('filieres.modules.presentiel', 'filieres.modules.synch')->get();
    $efps_data= [];
    foreach($efps as $efp){
    $efp_MH_G=0;
    $efp_MH_G_R=0;

    $efp_MH_P=0;
    $efp_MH_P_R=0;

    $efp_MH_S=0;
    $efp_MH_S_R=0;
        foreach($efp->filieres as $efp_filieres){
            foreach($efp_filieres->modules as $efp_module){
                $efp_MH_G+=$efp_module->MH_G;
                $efp_MH_G_R+=$efp_module->MH_G_realisé;
                
                $efp_MH_P+=$efp_module->presentiel->MH_P;
                $efp_MH_P_R+=$efp_module->presentiel->MH_P_Realisé;

                $efp_MH_S+=$efp_module->synch->MH_S;
                $efp_MH_S_R+=$efp_module->synch->MH_S_Realisé;
            }
        }
        $avancement_g[$efp->nom]=$efp_MH_G_R/$efp_MH_G*100;
        $avancement_p[$efp->nom]=$efp_MH_P_R/$efp_MH_P*100;
        $avancement_s[$efp->nom]=$efp_MH_S_R/$efp_MH_S*100;
    }
    // dd($efps_data);
    return view('efp',["efps"=>$efps,"avancement_g"=>$avancement_g,"avancement_p"=>$avancement_p,"avancement_s"=>$avancement_s]);
    // return view('efp',["efps"=>Efp::all()]);
});
Route::get('/efp/{id}', function ($id) {
    // Retrieve EFP and associated Filieres
    $efp = Efp::findOrFail($id);
    $filieres = $efp->filieres;

    // Initialize an empty array to store formateur data
    $formateurData = [];

    // Loop through each Filiere
    foreach ($filieres as $filiere) {
        // Get Modules for the current Filiere
        $modules = $filiere->modules;

        // Loop through each Module
        foreach ($modules as $module) {
            // Get Presentiels and Synches for the current Module
            $presentiel = $module->presentiel;
            $synch = $module->synch;

            $form_data[$presentiel->formateur->nom]['MH_P']=0;
            $form_data[$presentiel->formateur->nom]['MH_P']+=$presentiel->MH_P;
            $form_data[$presentiel->formateur->nom]['MH_P_R']=0;
            $form_data[$presentiel->formateur->nom]['MH_P_R']+=$presentiel->MH_P_Realisé;

            $form_data[$synch->formateur->nom]['MH_S']=0;
            $form_data[$synch->formateur->nom]['MH_S']+=$synch->MH_S;
            $form_data[$synch->formateur->nom]['MH_S_R']=0;
            $form_data[$synch->formateur->nom]['MH_S_R']+=$synch->MH_S_Realisé;

            $form_data[$presentiel->formateur->nom]['MH_G']=0;
            $form_data[$presentiel->formateur->nom]['MH_G']+=$module->MH_G;
            $form_data[$presentiel->formateur->nom]['MH_G_R']=0;
            $form_data[$presentiel->formateur->nom]['MH_G_R']+=$module->MH_G_realisé;

            

            // Loop through each Presentiel and Synch to gather formateur data
            
            
        }
        foreach ($modules as $module) {
                        // Get Presentiels and Synches for the current Module
                        $presentiel = $module->presentiel;
                        $synch = $module->synch;
            if($form_data[$presentiel->formateur->nom]['MH_P']!=0){
            $form_data[$presentiel->formateur->nom]['avancement_p']=$form_data[$presentiel->formateur->nom]['MH_P_R']/$form_data[$synch->formateur->nom]['MH_P']*100;
            }
            else{
                $form_data[$presentiel->formateur->nom]['avancement_p']=0;

            }
            if($form_data[$presentiel->formateur->nom]['MH_G']!=0){
                $form_data[$presentiel->formateur->nom]['avancement_g']=$form_data[$presentiel->formateur->nom]['MH_G_R']/$form_data[$synch->formateur->nom]['MH_G']*100;

            }
            else{
                $form_data[$presentiel->formateur->nom]['avancement_g']=0;

            }
            if($form_data[$synch->formateur->nom]['MH_S']!=0){
            $form_data[$presentiel->formateur->nom]['avancement_s']=$form_data[$synch->formateur->nom]['MH_S_R']/$form_data[$synch->formateur->nom]['MH_S']*100;
            }
            else{
                $form_data[$presentiel->formateur->nom]['avancement_s']=0;
            }
    
            
        }
        
        

    }
   
    // Pass the data to the view
    return view('efp_formateurs', compact('efp', 'form_data'));
}

);


