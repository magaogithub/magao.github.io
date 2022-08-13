<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUIDE PASTORALE</title>

    <!-- CSS only -->
    <link href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="libs/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>


    <script src="libs/jquery.js"></script>

    <script src="libs/v6.13.0-dist/ol.js"></script>
    <link rel="stylesheet" href="libs/v6.13.0-dist/ol.css">
<!-- Icône du titre -->

    <link rel="icon" type="image/x-icon" href="http://localhost:8081/app/image/favicon.ico"/>

<!-- fin de l'icone du titre -->
    <script src="libs/ol-layerswitcher-master/dist/ol-layerswitcher.js"></script>
    <link rel="stylesheet" href="libs/ol-layerswitcher-master/dist/ol-layerswitcher.css" />

    <script src="libs/ol-geocoder/ol-geocoder.js"></script>
    <link rel="stylesheet" href="libs/ol-geocoder/ol-geocoder.css" />

    <script src="libs/ol-popup/ol-popup.js"></script>
    <link rel="stylesheet" href="libs/ol-popup/ol-popup.css" />


    <link rel="stylesheet" href="libs/jquery-ui-1.12.1/jquery-ui.css">
    <script src="libs/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script src="libs/jquery-ui-1.12.1/jquery-ui.js"></script>




    <link rel="stylesheet" href="style.css">
</head>

<body>


    <div id="map" class="map">

        <div id="scale_bar"></div>
        <div id="scale_bar1"></div>
        <button onclick="wms_layers()" type="button" id="wms_layers_btn" class="btn btn-success btn-sm">Couches WMS disponibles</button>
        <button onclick="clear_all()" type="button" id="clear_btn" class="btn btn-warning btn-sm">Accueil</button>
        <button onclick="show_hide_querypanel()" type="button" id="query_panel_btn" class="btn btn-success btn-sm">☰ Pannaeau des tâches</button>
        <div id="legend"></div>
        <button onclick="show_hide_legend()" type="button" id="legend_btn" class="btn btn-success btn-sm">☰ Afficher légende</button>
        <button onclick="info()" type="button" id="info_btn" class="btn btn-success btn-sm">☰ Activer l'information</button>

        <select id="measuretype" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option value="select">Choisir l'option de mésure</option>
            <option value="length">Ligne</option>
            <option value="area">Polygone</option>
            <option value="clear">Annuler la mésure</option>
        </select>

    </div>
    <div id="query_tab">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist" style="font-size:14px;">
             <h3>   <button class="nav-link active" id="nav-attributes-tab" data-bs-toggle="tab" data-bs-target="#nav-attributes" type="button" role="tab" aria-controls="nav-attributes" aria-selected="true"><b>Sélections</b></button></h3>
             <h3>  <button class="nav-link" id="nav-draw-tab" data-bs-toggle="tab" data-bs-target="#nav-draw" type="button" role="tab" aria-controls="nav-draw" aria-selected="false"><b>Tirages</b></button></h3>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-attributes" role="tabpanel" aria-labelledby="nav-attributes-tab">
                <label for="layer"><b>Sélectionner une couche</b></label>
                <select id="layer" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Sélectionner une couche</option>
                </select>
                <br>
                <label for="attributes"><b>Selection par attribut</b></label>
                <select id="attributes" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Choisir un attribut</option>
                </select>
                <br>
                <label for="operator"><b>Choisir un attribut</b></label>
                <select id="operator" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Choisir une opération</option>
                </select>
                <br>
                <label for="value">Entrer une valeur</label>
                <input type="text" class="form-control form-select-sm" id="value" name="value">
                <br>
                <button onclick="query()" type="button" class="btn btn-danger btn-sm">Charger la couche</button>
                <br>
                <br>
                <h3><p> <b>Zones pastorales</b></p></h3>
                <br>
                <br>

                <h5><a href="https://magaoee2021.users.earthengine.app/view/appindice"> <b>Prédire ressources</b></a> </h5>
                <br>
                <br>
                <h5>  <a href="https://magaoee2021.users.earthengine.app/view/appmodele"><b>Aller aux zones pastorales</b> </a></h5>
                <br>

            </div>
            <div class="tab-pane fade" id="nav-draw" role="tabpanel" aria-labelledby="nav-draw-tab">
                <label for="layer1"><b>Choisir la couche</b></label>
                <select id="layer1" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Choisir la couche</option>
                </select>
                <br>
                <label for="draw_type"><b>Choisir type de géométrie</b></label>
                <select id="draw_type" class="form-select form-select-sm" aria-label=".form-select-sm example">

                    <option value="select">Forme</option>
                    <option value="Square">Carré</option>
                    <option value="Box">Boîte</option>
                    <option value="Polygon">Polygone</option>
                    <option value="Star">Étoile</option>
                    <option value="clear">Annuler</option>
                </select>


            </div>

        </div>

    </div>


    <div id="table_data" style="font-size:15px;"></div>
    <!-- Scrollable modal -->

    <div class="modal fade" id="wms_layers_window" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Couches WMS disponibles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="table_wms_layers" class="table table-hover" style="font-size:15px;">
                    </table>
                </div>
                <div class="modal-footer">
                    <button onclick="close_wms_window()" type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fermer</button>
                    <button onclick="add_layer()" type="button" id="add_map_btn" class="btn btn-primary btn-sm">Ajouter une couche à la carte</button>
                </div>
            </div>
        </div>
    </div>




    <script src="map.js"></script>

</body>

</html>