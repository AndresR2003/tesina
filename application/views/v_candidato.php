<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!--TABS-->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <p class="card-title-desc">150 candidatos registrados</p>
                            </div>
                            <div class="">
                                <button class="btn btn-sm btn-info"  id="btn_candidato" title="Agregar candidato nuevo" onclick="abrir_modal('mdl_add_candidato');">Nuevo Candidato</button>
                            </div> 
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item" style="border-left: 1px outset;">
                                <a class="nav-link active" data-bs-toggle="tab" href="#candidatos" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Nuevos <br>candidatos</span>
                                    <label>0</label>
                                </a>
                            </li>
                            <li class="nav-item" style="border-left: 1px outset;">
                                <a class="nav-link" data-bs-toggle="tab" href="#pendientes" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Postulantes <br>pendientes </span>
                                    <label>0</label>
                                </a>
                            </li>
                            <li class="nav-item" style="border-left: 1px outset;">
                                <a class="nav-link" data-bs-toggle="tab" href="#descartados" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Postulantes <br>descartados </span>
                                    <label>0</label>
                                </a>
                            </li>
                            <li class="nav-item" style="border-left: 1px outset;">
                                <a class="nav-link" data-bs-toggle="tab" href="#en_proceso" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Postulantes <br> en proceso </span>
                                    <label>0</label>
                                </a>
                            </li>
                            <li class="nav-item" style="border-left: 1px outset;">
                                <a class="nav-link" data-bs-toggle="tab" href="#entrevista_telefonica" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Entrevista <br> telefónica </span>
                                    <label>0</label>
                                </a>
                            </li>
                            <li class="nav-item" style="border-left: 1px outset;">
                                <a class="nav-link" data-bs-toggle="tab" href="#entrevista_presencial" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Entrevista <br> presencial </span>
                                    <label>0</label>
                                </a>
                            </li>   
                            <li class="nav-item" style="border-left: 1px outset;">
                                <a class="nav-link" data-bs-toggle="tab" href="#en_pruebas" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Postulantes <br> en pruebas </span>
                                    <label>0</label>
                                </a>
                            </li>                               
                        </ul>

                        <!-- Tab panel -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="candidatos" role="tabpanel">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img width="45px" src="./public/images/iconos/women.png" alt="Mujer"/>
                                                    <div style="margin-left:15px">
                                                        <h5>Isabel Elzalde Quiles</h5>
                                                        <span>La fontana 512 - Los olivos - 24 años</span>
                                                    </div>
                                                </div>

                                                <div class="btn-group me-1 mt-2">
                                                    <button class="btn btn-secondary btn-sm" type="button">
                                                        Opciones
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        <button class="dropdown-item" onclick="visualizar_pdf();">Visualizar CV</button>
                                                        <a class="dropdown-item" href="./uploads/cv/cv1.pdf" download="CV Isabel Elzalde Quiles">Descargar CV</a>
                                                        <button class="dropdown-item" onclick="programar_entrevista();">Programar Entrevista</button>
                                                        <button class="dropdown-item" onclick="mover_candidato();">Mover Candidato</button>
                                                        <div class="dropdown-divider"></div>
                                                        <button class="dropdown-item" onclick="mover_candidato();">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <!--Experiencias-->
                                            <section>
                                                <div class="d-flex align-items-center">
                                                    <img src="./public/images/iconos/experiencia.png" alt="Experiencias"/>
                                                    <div class="d-flex flex-column align-items-start p-1">
                                                        <h6>Responsable de mantenimiento y lean manufacturing - Schooeller S.A</h6>
                                                        <span>Abril 2017 - Actualmente (2 años y medio)</span>
                                                    </div>
                                                </div>
                                            </section>

                                            <!--Formación-->
                                            <section>
                                                <div class="d-flex align-items-center">
                                                    <img src="./public/images/iconos/formacion.png" alt="Formación"/>
                                                    <div class="d-flex flex-column align-items-start p-1">
                                                        <h6>Grado en Marketing - Universidad de Lima</h6>
                                                        <span>2011 - 2016</span>
                                                    </div>
                                                </div>
                                            </section>

                                            <!--Conocimiento-->
                                            <section>
                                                <div class="d-flex align-items-center">
                                                    <img src="./public/images/iconos/herramienta.png" alt="Herramientas"/>
                                                    <div class="d-flex flex-column align-items-start p-1">
                                                        <h6>Herramientas</h6>
                                                        <ol>
                                                            <li>Excel Avanzado</li>
                                                            <li>Navicat Avanzado</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </section>                                            

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img width="45px" src="./public/images/iconos/women.png" alt="Mujer"/>
                                                    <div style="margin-left:15px">
                                                        <h5>Melissa Flores Quevedo</h5>
                                                        <span>Los girasoles 2332 - SMP - 27 años</span>
                                                    </div>
                                                </div>
                                                <div class="btn-group me-1 mt-2">
                                                    <button class="btn btn-secondary btn-sm" type="button">
                                                        Opciones
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        <button class="dropdown-item" onclick="visualizar_pdf();">Visualizar CV</button>
                                                        <a class="dropdown-item" href="./uploads/cv/cv1.pdf" download="CV Isabel Elzalde Quiles">Descargar CV</a>
                                                        <button class="dropdown-item" onclick="programar_entrevista();">Programar Entrevista</button>
                                                        <button class="dropdown-item" onclick="mover_candidato();">Mover Candidato</button>
                                                        <div class="dropdown-divider"></div>
                                                        <button class="dropdown-item" onclick="mover_candidato();">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>                                                                                    
                                        </div>
                                        <div class="card-body">
                                            <!--Experiencias-->
                                            <section>
                                                <div class="d-flex align-items-center">
                                                    <img src="./public/images/iconos/experiencia.png" alt="Experiencias"/>
                                                    <div class="d-flex flex-column align-items-start p-1">
                                                        <h6>Responsable Manufacturing - SasDys S.A</h6>
                                                        <span>Abril 2022 - Actualmente (3 años y medio)</span>
                                                    </div>
                                                </div>
                                            </section>

                                            <!--Formación-->
                                            <section>
                                                <div class="d-flex align-items-center">
                                                    <img src="./public/images/iconos/formacion.png" alt="Formación"/>
                                                    <div class="d-flex flex-column align-items-start p-1">
                                                        <h6>Grado en Industrial - Universidad Peruana de Ciencias Aplicadas</h6>
                                                        <span>2015 - 2022</span>
                                                    </div>
                                                </div>
                                            </section>

                                            <!--Conocimiento-->
                                            <section>
                                                <div class="d-flex align-items-center">
                                                    <img src="./public/images/iconos/herramienta.png" alt="Herramientas"/>
                                                    <div class="d-flex flex-column align-items-start p-1">
                                                        <h6>Herramientas</h6>
                                                        <ol>
                                                            <li>Excel Avanzado</li>
                                                            <li>Bizagui Avanzado</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </section>                                            

                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--MODALES-->

<!--MODAL VISUALIZAR PDF-->
<div class="modal fade bs-example-modal-xl" id="mdl_preview_pdf" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Vista Previa de CV seleccionado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="./uploads/cv/cv1.pdf" style="width:100%; height:650px;" frameborder="0" ></iframe>
            </div>
        </div>
    </div>
</div>

<!--MODAL AGREGAR CANDIDATO-->
<div id="mdl_add_candidato" class="modal fade" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo candidato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!--Registrar Datos-->
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Paso 1: Registrar Datos</h5>
                                <span>Ingrese los datos principales solicitados.</span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-1">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Nombres</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm"  placeholder="Nombres completos" id="txt_nombres_add">
                                    </div>
                                </div> 
                                <div class="row mb-1">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Apellidos</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm"  placeholder="Apellidos completos" id="txt_apellidos_add">
                                    </div>
                                </div> 
                                <div class="row mb-1">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">F. Nac</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-sm" type="date" value="" id="txt_f_nacimiento_add">
                                    </div>
                                </div>                                 
                            </div> 
                            
                            <div class="card-body">
                                <div class="row mb-1">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">T. Doc</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm" id="txt_tipo_documento_add">
                                            <option value="">Tipo Documento</option>
                                            <option value="1">DNI</option>
                                            <option value="2">PASAPORTE</option>
                                        </select>                                              
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Nro.</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-sm" type="number" value="" id="txt_nro_documento_add">
                                    </div>
                                </div>                                
                            </div> 
                         
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-1">
                                        <label for="example-text-input" class="form-label">Correo</label>
                                        <input class="form-control form-control-sm" type="text" value="" placeholder="Correo electrónico" id="txt_correo_add">
                                    </div>                                    
                                    <div class="col-lg-12 mb-1">
                                        <label for="example-text-input" class="form-label">Celular</label>
                                        <input class="form-control form-control-sm" type="text" value="" placeholder="999 999 999" id="txt_celular_add">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-1">
                                        <span id="mensaje_add" style="color:red;"></span>
                                    </div>
                                    <div class="col-lg-12 mb-1">
                                        <button class="btn btn-sm btn-secondary form-control" onclick="registrar_candidato();" id="btn_registrar_candidato">Registrar Candidato</button>
                                    </div>                                    
                                </div>
                            </div>    

                        </div>
                    </div>

                    <!--Menú-->
                    <div class="col-xl-7">
                        <div class="card" id="panel_paso_2_nr" >
                            <div class="card-header">
                                <h5 class="card-title">Paso 2: Registro de información adicional</h5>
                                <p class="card-title-desc">De acuerdo a la opción ingrese la información más relevante</p>
                            </div>   
                            <div class="card-body">
                                <span>* Registre un candidato para obtener más opciones</span>
                            </div>
                        </div>

                        <div class="card" id="panel_paso_2_cr" style="display:none;">
                            <div class="card-header">
                                <h5 class="card-title">Paso 2: Registro de información adicional</h5>
                                <p class="card-title-desc">De acuerdo a la opción ingrese la información más relevante</p>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill" href="#candidatura" role="tab" aria-controls="v-pills-home" aria-selected="true">Candidatura</a>
                                            <a class="nav-link mb-2 " id="v-pills-home-tab" data-bs-toggle="pill" href="#direccion" role="tab" aria-controls="v-pills-home" aria-selected="true">Dirección</a>
                                            <a class="nav-link mb-2 " id="v-pills-home-tab" data-bs-toggle="pill" href="#experiencia" role="tab" aria-controls="v-pills-home" aria-selected="true">Experiencias</a>
                                            <a class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" href="#formacion" role="tab" aria-controls="v-pills-profile" aria-selected="false">Formación</a>
                                            <a class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" href="#cv" role="tab" aria-controls="v-pills-profile" aria-selected="false">CV</a>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">

                                            <!--Dirección-->
                                            <div class="tab-pane fade show " id="direccion" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Dirección</h5>
                                                        <span>Detalle de dirección del postulante.</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-1">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Departamento: </label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control form-control-sm" id="select_departamento_add" onchange="get_data_ubigeo('provincia');">
                                                                    <option value="">Seleccione departamento</option>
                                                                </select>                                              
                                                            </div>
                                                        </div>

                                                        <div class="row mb-1">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Provincia: </label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control form-control-sm" id="select_provincia_add" onchange="get_data_ubigeo('distrito');">
                                                                    <option value="">Seleccione provincia</option>
                                                                </select>                                              
                                                            </div>
                                                        </div> 

                                                        <div class="row mb-1">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Distrito:</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control form-control-sm" id="select_distrito_add">
                                                                    <option value="">Seleccione distrito</option>
                                                                </select>                                              
                                                            </div>
                                                        </div>

                                                        <div class="row mb-1">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Dirección:</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm" id="text_direccion_add" placeholder="Dirección">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row mb-3">
                                                            <div class="col-sm-9">
                                                                <button class="btn btn-sm btn-secondary" onclick="actualizar_registro('direccion');">Actualizar dirección </button>
                                                            </div>
                                                        </div>
                                                                                                                
                                                    </div> 
                                                </div>
                                            </div>

                                            <!--CANDIDATURA-->
                                            <div class="tab-pane fade show active" id="candidatura" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Candidaturas</h5>
                                                        <span>Seleccione la candidatura del candidato.</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-9 mb-1">
                                                                <label for="example-text-input" class="form-label">Solicitud</label>
                                                                <select class="form-control form-control-sm" id="txt_solicitud_asignar">
                                                                    <option value="">Solicitudes Disponibles</option>
                                                                    <option value="1">Programador Junior 2</option>
                                                                    <option value="2">Asistente de TI</option>
                                                                    <option value="3">Soporte de TI</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label" style="color:white;">_</label>
                                                                <button class="btn btn-sm btn-secondary form-control form-control-sm" onclick="asignar_candidato();">Registrar</button>
                                                            </div>                                                                                                                          
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Registros</h5>
                                                        <span>Candidatura registradas</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <!--Experiencias-->
                                                            <div class="col-lg-12" id="panel_candidatura">
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
    
                                            <!--EXPERIENCIA-->
                                            <div class="tab-pane fade show " id="experiencia" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Experiencias</h5>
                                                        <span>Ingrese los datos principales solicitados.</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label">Empresa</label>
                                                                <input class="form-control form-control-sm" type="text" value="" id="" placeholder="Nombre de la empresa de trabajo">
                                                            </div>
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label">Cargo</label>
                                                                <input class="form-control form-control-sm" type="text" value="" placeholder="Cargo ocupado en la empresa" id="">
                                                            </div>
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label">Fecha inicio</label>
                                                                <input class="form-control form-control-sm" type="date" id="">
                                                            </div> 
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label">Fecha Fin</label>
                                                                <input class="form-control form-control-sm" type="date" id="">
                                                            </div>
                                                            <div class="col-lg-8 mb-1">
                                                                <label for="example-text-input" class="form-label">Contacto & Celular</label>
                                                                <input class="form-control form-control-sm" type="text" id="" value="Nombre Contacto y Celular">
                                                            </div>
                                                            <div class="col-lg-4 mb-1">
                                                                <label for="example-text-input" class="form-label" style="color:white;">_</label>
                                                                <button class="btn btn-sm btn-secondary form-control form-control-sm ">Registrar Experiencia</button>
                                                            </div>                                                                                                                          
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Registros</h5>
                                                        <span>Lista de experiencias registradas</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <!--Experiencias-->
                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="./public/images/iconos/experiencia.png" alt="Experiencias"/>
                                                                        <div class="d-flex flex-column align-items-start p-2">
                                                                            <h6>Responsable Manufacturing - SasDys S.A</h6>
                                                                            <span>Abril 2022 - Actualmente (3 años y medio)</span>
                                                                            <span>Susan Alvarez (Gerente) - 963258741</span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="./public/images/iconos/experiencia.png" alt="Experiencias"/>
                                                                        <div class="d-flex flex-column align-items-start p-2">
                                                                            <h6>Responsable de Marketing - OASIS S.A.C</h6>
                                                                            <span>Junio 2021 - Abril 2021 (1 años y medio)</span>
                                                                            <span>Mirian Vaca (Gerente Ope.) - 951357825</span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="./public/images/iconos/experiencia.png" alt="Experiencias"/>
                                                                        <div class="d-flex flex-column align-items-start p-2">
                                                                            <h6>Área contable  - ABOGADOS Y ESTUDIOS S.A.C</h6>
                                                                            <span>Abril 2022 - Junio 2021 (1 años y medio)</span>
                                                                            <span>Ana Rengifo(Supervisor Contable.) - 958658256</span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                                                    </div>
                                                                </div>                                                                    
                                                            </div>  

                                                        </div>
                                                    </div> 
                                                </div>

                                            </div>

                                            <!--FORMACION-->
                                            <div class="tab-pane fade show" id="formacion" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Formación</h5>
                                                        <span>Ingrese los datos principales solicitados.</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label">Institución</label>
                                                                <input class="form-control form-control-sm" type="text" value="" id="" placeholder="Nombre de la empresa de trabajo">
                                                            </div>
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label">Nivel académico</label>
                                                                <input class="form-control form-control-sm" type="text" value="" placeholder="Cargo ocupado en la empresa" id="">
                                                            </div>
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label">Fecha Inicio</label>
                                                                <input class="form-control form-control-sm" type="date" id="">
                                                            </div>
                                                            <div class="col-lg-3 mb-1">
                                                                <label for="example-text-input" class="form-label">Fecha Fin</label>
                                                                <input class="form-control form-control-sm" type="date" id="">
                                                            </div> 
                                                            <div class="col-lg-4 mb-1">
                                                                <label for="example-text-input" class="form-label" style="color:white;">_</label>
                                                                <button class="btn btn-sm btn-secondary form-control form-control-sm ">Registrar Formación</button>
                                                            </div>                                                                                                                          
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Registros</h5>
                                                        <span>Lista de estudios registrados</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <!--Experiencias-->
                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="./public/images/iconos/formacion.png" alt="Experiencias"/>
                                                                        <div class="d-flex flex-column align-items-start p-2">
                                                                            <h6>UPC  (Universidad)</h6>
                                                                            <span>Abril 2026 - Abril 2031</span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="./public/images/iconos/formacion.png" alt="Experiencias"/>
                                                                        <div class="d-flex flex-column align-items-start p-2">
                                                                            <h6>Juan Pablo II  (Secundaria)</h6>
                                                                            <span>Abril 2021 - Abril 2026</span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                                                    </div>
                                                                </div>                                                                    
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="./public/images/iconos/formacion.png" alt="Experiencias"/>
                                                                        <div class="d-flex flex-column align-items-start p-2">
                                                                            <h6>Instituto 11:35 ( Primaria)</h6>
                                                                            <span>Abril 2015 - Abril 2021</span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                                                    </div>
                                                                </div>                                                                     
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="./public/images/iconos/formacion.png" alt="Experiencias"/>
                                                                        <div class="d-flex flex-column align-items-start p-2">
                                                                            <h6>Los Gallitos de las Rocas (Inicial)</h6>
                                                                            <span>Abril 2010 - Abril 2015</span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                                                    </div>
                                                                </div>                                                                      
                                                            </div>  

                                                        </div>
                                                    </div> 
                                                </div>

                                            </div>

                                            <!--CV-->
                                            <div class="tab-pane fade show" id="cv" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Adjuntar CV</h5>
                                                        <span>Seleccione un archivo en formato PDF.</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 mb-1">
                                                                <label for="example-text-input" class="form-label">Archivo</label>
                                                                <input class="form-control form-control-sm" type="file" value="" id="">
                                                            </div>

                                                            <div class="col-lg-12 mb-2">
                                                                <button class="btn btn-sm btn-secondary">Subir</button>
                                                            </div>                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>                                            
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Historial Cambios-->
                    <div class="col-xl-2">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Actividades realizadas</h5>
                                <span>Lista de actividades realizadas</span>
                            </div>
                            <div class="card-body">
                                <div id="list_actividades">
                                </div>
                            </div> 
                        </div>
                    </div>                    

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-info waves-effect" onclick="nuevo_candidato();" >Nuevo Candidato</button>
                <button type="button" class="btn btn-sm btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    let cod_registro_postulante=0; 
    
    $(document).ready(function() {
        get_data_ubigeo('departamento');
    });

    /*
        FUNCTIONES DE UBIGEO
    */
        /*Obtener dato de ubigeos*/
        function get_data_ubigeo(tipo){
            var id=''; 
            switch (tipo) {
                case 'provincia':
                    id = get_data('select_departamento_add');
                    break;
                case 'distrito':
                    id = get_data('select_provincia_add');
                    break;                    
                    
                default:
                    break;
            }

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '<?php echo base_url();?>C_ubigeo/get_data_ubigeo',
                data: {
                    'tipo':tipo,
                    'id':id
                }, 
                beforeSend:function(){
                },   
                success: function(e){ 
                    var cadena='<option value="">Seleccione</option>';
                    for(var i=0; i < e.length; i++)
                    {
                        cadena +='<option value="'+e[i]['id']+'">'+e[i]['descripcion']+'</option>'
                    }

                    switch (tipo) {
                        case 'departamento':
                            $('#select_departamento_add').html(cadena);
                            //$('#text_departamento').val(id);
                            break;
                        case 'provincia':
                            $('#select_provincia_add').html(cadena);
                            //$('#text_provincia').val(id_provincia);
                            break;          
                        case 'distrito':
                            $('#select_distrito_add').html(cadena);
                            //$('#text_distrito').val(id_distrito);
                        break;                                                              
                        default:
                            break;
                    }
                }
            });              
        }

    /*
        FUNCIONES DE LA PÁGINA
    */  
        /*Agregar nuevo candidato*/
        function nuevo_candidato(){
            deshabilitar_registro_inf_adicional(); 
            $('#btn_registrar_candidato').removeAttr('disabled');
            limpiar_inputs('registrar_candidato'); 

        }

        /*Obtener datos de acuerdo al id*/
        function get_data(input){
            return $('#'+input).val();
        }

        /*Limpiar bordes de acuerdo al tipo de formulario enviado*/
        function limpiar_bordes(tipo){
            switch (tipo) {
                case 'registrar_candidato':
                    $('#txt_correo_add').css('border','1px solid #ced4da');
                    $('#txt_celular_add').css('border','1px solid #ced4da');
                    $('#txt_nro_documento_add').css('border','1px solid #ced4da');
                    $('#txt_tipo_documento_add').css('border','1px solid #ced4da');
                    $('#txt_f_nacimiento_add').css('border','1px solid #ced4da');
                    $('#txt_apellidos_add').css('border','1px solid #ced4da');
                    $('#txt_nombres_add').css('border','1px solid #ced4da');                
                    break;
                case 'registrar_candidatura':
                    $('#txt_solicitud_asignar').css('border','1px solid #ced4da');
                    $('#txt_solicitud_asignar').val('');
                    break;
                    
                case 'registrar_candidatura':
                    $('#select_departamento_add').css('border','1px solid #ced4da');
                    $('#select_provincia_add').css('border','1px solid #ced4da');
                    $('#select_distrito_add').css('border','1px solid #ced4da');
                    $('#text_direccion_add').css('border','1px solid #ced4da');
                    break;                    
                    
                default:
                    break;
            }

        }

        function limpiar_inputs(tipo){
            switch (tipo) {
                case 'registrar_candidato':
                    cod_registro_postulante=0; 
                    $('#txt_correo_add').val('');
                    $('#txt_celular_add').val('');
                    $('#txt_nro_documento_add').val('');
                    $('#txt_tipo_documento_add').val('');
                    $('#txt_f_nacimiento_add').val('');
                    $('#txt_apellidos_add').val('');
                    $('#txt_nombres_add').val('');
                    $('#mensaje_add').text('');
                    break;
                default:
                    break;
            }

        }

    /*
        FUNCIONES AGREGAR
        -- AGREGAR POSTULANTE MODAL FULL
    */
        /*Registrar candidatura asignación */
        function registrar_candidatura_asignacion(){
            //Se requiere id de candidatura seleccionado
            let txt_solicitud_asignar          = get_data('txt_solicitud_asignar');
            console.log('txt_solicitud_asignar: '+txt_solicitud_asignar);
            let contador=0;
            if(txt_solicitud_asignar==''){alerta('error','txt_solicitud_asignar','','');contador++;}else{alerta('success','txt_solicitud_asignar','','');}
            //Se requiere id del candidato registrado

        }

        /*Registrar candidato*/
        function registrar_candidato(){
            let txt_correo_add          = get_data('txt_correo_add');
            let txt_celular_add         = get_data('txt_celular_add');
            let txt_nro_documento_add   = get_data('txt_nro_documento_add');
            let txt_tipo_documento_add  = get_data('txt_tipo_documento_add');
            let txt_f_nacimiento_add    = get_data('txt_f_nacimiento_add');
            let txt_apellidos_add       = get_data('txt_apellidos_add');
            let txt_nombres_add         = get_data('txt_nombres_add');

            console.log('txt_correo_add: '+txt_correo_add);
            console.log('txt_celular_add: '+txt_celular_add);
            console.log('txt_nro_documento_add: '+txt_nro_documento_add);
            console.log('txt_tipo_documento_add: '+txt_tipo_documento_add);
            console.log('txt_f_nacimiento_add: '+txt_f_nacimiento_add);
            console.log('txt_apellidos_add: '+txt_apellidos_add);
            console.log('txt_nombres_add: '+txt_nombres_add);

            let contador=0;
            if(txt_correo_add==''){alerta('error','txt_correo_add','','');contador++;}else{alerta('success','txt_correo_add','','');}
            if(txt_celular_add==''){alerta('error','txt_celular_add','','');contador++;}else{alerta('success','txt_celular_add','','');}
            if(txt_nro_documento_add==''){alerta('error','txt_nro_documento_add','','');contador++;}else{alerta('success','txt_nro_documento_add','','');}
            if(txt_tipo_documento_add==''){alerta('error','txt_tipo_documento_add','','');contador++;}else{alerta('success','txt_tipo_documento_add','','');}
            if(txt_f_nacimiento_add==''){alerta('error','txt_f_nacimiento_add','','');contador++;}else{alerta('success','txt_f_nacimiento_add','','');}
            if(txt_apellidos_add==''){alerta('error','txt_apellidos_add','','');contador++;}else{alerta('success','txt_apellidos_add','','');}
            if(txt_nombres_add==''){alerta('error','txt_nombres_add','','');contador++;}else{alerta('success','txt_nombres_add','','');}

            if(contador>0){
                $('#mensaje_add').css('color','red');
                $('#mensaje_add').text('¡No se pudo registrar! Uno o más registros están vacíos...');
                notificacion('¡ Ocurrió algo !','Toda la información solicitada es importante para el reclutamiento del personal.','error');
            }else{
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?php echo base_url();?>C_candidato/registrar',
                    data: {
                        'tipo':'candidato',
                        'txt_correo_add':txt_correo_add,
                        'txt_celular_add':txt_celular_add,
                        'txt_nro_documento_add':txt_nro_documento_add,
                        'txt_tipo_documento_add':txt_tipo_documento_add,
                        'txt_f_nacimiento_add':txt_f_nacimiento_add,
                        'txt_apellidos_add':txt_apellidos_add,
                        'txt_nombres_add':txt_nombres_add
                    }, 
                    beforeSend:function(){
                    },   
                    success: function(e){ 
                        $('#mensaje_add').css('color','green');
                        $('#mensaje_add').text(' Candidato registrado correctamente...');
                        notificacion('¡ Postulante Registrado !','Ingrese la información adicional del postulante para un mejor seguimiento.','success');
                        //Si todo es correcto.. servidor retorna un código
                        cod_registro_postulante=e;
                        //Habilitamos el registro de información adicional
                        habilitar_registro_inf_adicional();
                        //Limpiamos bordes y registramos actividad realizada
                        setTimeout(() => {
                            limpiar_bordes('registrar_candidato');
                            actividad_realizada('Se registro un candidato con código '+cod_registro_postulante+ ' a las 10:45 am');
                            //Desactivamos el botón registrar candidato
                            $('#btn_registrar_candidato').attr('disabled','true');
                            //Cargamos solicitud
                            load_tipos('solicitud');
                        }, 1500);
                    }
                });
            }
        }

        /*Asignar candidato a candidatura disponible*/
        function asignar_candidato(){
            let txt_solicitud_asignar          = get_data('txt_solicitud_asignar');
            let txt_seleccion_texto            = $('#txt_solicitud_asignar option:selected').text()

            console.log('txt_solicitud_asignar: '+txt_correo_add);
            let contador=0;
            if(txt_solicitud_asignar==''){alerta('error','txt_solicitud_asignar','','');contador++;}else{alerta('success','txt_solicitud_asignar','','');}
            if(contador>0){
                notificacion('¡ Ocurrió algo !','Para realizar la asignación del candidato asegurate que se haya seleccionado la solicitud.','error');
            }else{
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?php echo base_url();?>C_candidato/registrar',
                    data: {
                        'tipo':'asignacion_candidatura',
                        'txt_solicitud_asignar':txt_solicitud_asignar,
                        'cod_registro_postulante':cod_registro_postulante
                    }, 
                    beforeSend:function(){
                    },   
                    success: function(e){ 
                        notificacion('¡ Candidatura Asignada !','Se registro al caldidato en la candidatura seleccionado.','success');
                        //Limpiamos bordes y registramos actividad realizada
                        setTimeout(() => {
                            limpiar_bordes('registrar_candidatura');
                            actividad_realizada('Se asignó al candidato a la solicitud '+ txt_seleccion_texto +' '+cod_registro_postulante+ ' a las 11:45 am');
                            //Cargamos el registro
                            load_tipos('solicitud');
                        }, 1500);
                    }
                });
            }
        }

        function load_tipos(tipo){
            //Ajax
            switch (tipo) {
                case 'solicitud':
                        $.ajax({
                            type: "POST",
                            //dataType: 'json',
                            url: '<?php echo base_url();?>C_candidato/load_tipos',
                            data: {
                                'tipo':tipo,
                                'cod_registro_postulante':cod_registro_postulante
                            }, 
                            beforeSend:function(){
                            },   
                            success: function(e){ 
                                var json         = eval("(" + e + ")");
                                
                                $('#txt_solicitud_asignar').html(json.solicitud);
                                $('#panel_candidatura').html(json.reg_candidaturas);
                                /*var res = jQuery.parseJSON(e);
                                for (let index = 0; index < e.length; index++) {
                                    const element = e[index];
                                    
                                }*/
                                //$('#s_mes').html(res.mes_solicitud);
                            }
                        });                    
                    break;
                default:
                    break;
            }
        }

        /*Habilitar panel de registro*/
        function habilitar_registro_inf_adicional(){
            $('#panel_paso_2_nr').css('display','none');
            $('#panel_paso_2_cr').css('display','block');
        }

        function deshabilitar_registro_inf_adicional(){
            $('#panel_paso_2_nr').css('display','block');
            $('#panel_paso_2_cr').css('display','none');
        }

        /*Actualizar dirección de candidato*/
        function actualizar_registro(tipo){
            switch (tipo) {
                case 'direccion':
                    let contador=0;
                    let id_dep      = get_data('select_departamento_add');
                    if(id_dep==''){alerta('error','select_departamento_add','','');contador++;}else{alerta('success','select_departamento_add','','');}
                    let id_prov     = get_data('select_provincia_add');
                    if(id_prov==''){alerta('error','select_provincia_add','','');contador++;}else{alerta('success','select_provincia_add','','');}
                    let id_distrito   = get_data('select_distrito_add'); 
                    if(id_distrito==''){alerta('error','select_distrito_add','','');contador++;}else{alerta('success','select_distrito_add','','');}
                    let direccion   = get_data('text_direccion_add');
                    if(direccion==''){alerta('error','text_direccion_add','','');contador++;}else{alerta('success','text_direccion_add','','');}
                    
                    if(contador>0){
                        notificacion('Ocurrió algo','Uno o más datos no se encuentran correctos.','error');
                        return;
                    }
                    
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url();?>C_candidato/actualizar',
                        data: {
                            'id_dep':id_dep,
                            'id_prov':id_prov,
                            'id_distrito':id_distrito,
                            'direccion':direccion,
                            'cod_registro_postulante':cod_registro_postulante
                        }, 
                        beforeSend:function(){
                        },   
                        success: function(data){ 
                            notificacion('Datos actualizados','La información de su perfíl se actualizó correctamente','success');
                        }
                    });
                    break;
                default:
                    break;
            }
        }


    /*
        ACTIVIDAD REALIZADA
    */
        /*Función de registro de actividad realizada*/
        function actividad_realizada(texto){
            let html = $('#list_actividades').html();
            $('#list_actividades').html(html+'<p style="font-size:12px;"><i class="fa fa-check"></i> '+texto+' - 09:14</p>');
        }




    function abrir_modal(n_modal){
        $('#'+n_modal).modal('show');
    }

    function visualizar_pdf(){
        $('#mdl_preview_pdf').modal('show');
    }
</script>