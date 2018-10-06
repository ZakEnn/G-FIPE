<template>
    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center text-bold">Formulaire d'évaluation a chaud </h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <p class="text-center">( Salle de Formation : ................  ), le : .... / .... / ....... </p>
                        <h5 class="text-bold " style="text-decoration: underline;">Action : ......................................  </h5>
                        <h5 class="text-bold">Formateur : ..................</h5>
                        <h7>Nom et Prenom du participant : .................. </h7><br/>
                        <hr>
                        <div id="example2_wrapper" class=""><div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                            <div class="row">
                                <div class="col-sm-12">
                                <table class="table table-bordered " role="grid" >
                                    <thead>
                                    <tr role="row">
                                        <th >Criteres d'appréciation</th>
                                        <th >Appréciation</th>
                                        <th >Commentaire</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="background-color: whitesmoke">Evaluation de l'animation</td>
                                            <td  style="background-color: whitesmoke"></td>
                                            <td style="background-color: whitesmoke"></td>
                                        </tr>
                                        <tr role="row" class="odd">
                                            <td >Capacité de l'animateur a transmettre des connaissances</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="odd">
                                            <td >Capacité de l'animateur a faire participer le groupe de formation</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: whitesmoke">Evaluation du contenu</td>
                                            <td  style="background-color: whitesmoke"></td>
                                            <td style="background-color: whitesmoke"></td>
                                        </tr>
                                       <tr role="row" class="odd">
                                            <td >Developpement des axes prévus de la formation</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="odd">
                                            <td >Adaptation du contenu aux exigences de votre emploi</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: whitesmoke">Evaluation du transfert</td>
                                            <td  style="background-color: whitesmoke"></td>
                                            <td style="background-color: whitesmoke"></td>
                                        </tr>
                                        <tr role="row" class="odd">
                                            <td >Capacité a mettre en pratique les connaissances acquises dans votre travail</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                  </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Aspect positifs de la formation</th>
                                <th rowspan="1" colspan="2">Aspect négatifs de la formation(a developper)</th>
                            </tr>
                            <tr>
                                <td rowspan="1" colspan="1" height="200px"></td>
                                <td rowspan="1" colspan="2" height="200px;"></td>
                            </tr>
                            </tfoot>
                              </table>
                            <br>
                                <p class="text-center">Merci de votre participation a l'evaluation de cette formation</p>
                          </div>
                          </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        mounted(){
            console.log('Component mounted');
        }
    }
</script>

<style scoped>

</style>