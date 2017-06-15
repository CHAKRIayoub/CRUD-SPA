<template>


    <div class="col-md-12">

         <div id="other" style="

            display: none;
            z-index: 1000;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(34, 34, 34, 0.76);
            text-align: center;
            transition: transform 0.6s ease;">
                
        </div>
        <br><br>
        <div class="pull-left">

            <h3> liste des Produits :</h3><br><br>

        </div>

        <div class="row pull-right">
            <router-link to="createProduct" >

                <!-- bouton ajouter _______________________________________________________ -->
                <a class="btn btn-success " style=" 
                    border-radius: 50%;   
                    width: 95px;
                    height: 95px;
                    text-align: center;
                    font-size: 45px;
                ">
                +
                    <!--<span class="glyphicon glyphicon-plus-sign"  aria-hidden="true" style="font-size: 72px" ></span><br>
                    Ajouter un client-->
                </a> 
                <!-- bouton ajouter _______________________________________________________ -->

            </router-link>
        </div>
        <br><br><br><br><br><br>

        <div class="row">
            <div class="col-md-12 ">
               
                <!-- rechrche form _______________________________________________ -->
                <form class="navbar-form navbar-left" @submit.prevent="cherch()">

                    <div class="form-group">

                        <!-- input recherche _______________________________________ -->
                        <input style="width: 600px; font-size: 40px "  type="text" class="form-control srch " placeholder="Chercher" v-model="chercher"  >
                        <!-- input recherche _______________________________________ -->

                   </div>

                    <!-- bouton recherche _______________________________________ 
                    <button type="submit" class="btn btn-default">Chercher</button>
                    <- bouton recherche _______________________________________ -->

                </form>
                <!-- rechrche form _______________________________________________ -->

                <br><br>

                <!-- chargement label _______________________________________ -->
                <div v-if="loading" > chargement ... <br><br> </div>
                <!-- chargement label _______________________________________ -->

                <br><br><br><br>

                <!-- list clients _______________________________________ -->
                <div style="display:inline-block; padding: 20px"  v-for="product in filteredProducts" >
              <div class="panel panel-default">

                <div class="panel-heading">

                    <!-- button modifier _______________________________________ -->
                        <div  v-show="!showform(product.id)"  @click="editthis(product.id)" class="btn btn-primary pull-right btn-rd"  >
                             
                             <span class="glyphicon glyphicon-pencil"  aria-hidden="true"></span>
                             

                        </div> 
                        <!-- button modifier _______________________________________ -->

                        <!-- button supprimer _______________________________________ -->
                        <div v-show="!showform(product.id)"  @click="supprimer(product.id)"  class="btn btn-danger pull-right btn-rd"    >
                                
                            <span class="glyphicon glyphicon-trash"  aria-hidden="true"></span>
                                 

                        </div>
                    </div>

                
                    <!-- button supprimer _______________________________________ -->

                    <!-- form modifier _______________________________________ -->
                    <form @submit.prevent="update(product.id)" >

                        <div class="panel-body">
                            
                            <!-- label Nom Prenom (client) _______________________________ -->
                            <h5 style="width: 400px" v-show="!showform(product.id)" > 
                            {{ product.name }} {{ product.slug }} </h5>
                            <!-- Text Nom Prenom (client) _______________________________ -->

                            <div v-show="showform(product.id)" class="alert alert-danger" v-for="error in errors" >
                                <button onclick="this.parentElement.style.display = 'none';" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{ error }} 
                            </div>

                            <!-- input Nom Prenom modifier (client) _______________________ -->
                            <input style="width: 400px" v-show="showform(product.id)" type="text" class="form-control" v-model="EditCusData.name" >
                            <input style="width: 400px" v-show="showform(product.id)" type="text" class="form-control" v-model="EditCusData.slug" >
                            <!-- input Nom Prenom modifier (client) _________________________ -->                                
                       

                            <!-- Text role email (client) _______________________ -->
                            <span v-show="!showform(product.id)" >type : {{ product.type }} </span>

                            <br>
                           
                            <span v-show="!showform(product.id)" >Prix : {{ product.sale_price }} </span>

                            <br>



                            <input v-show="showform(product.id)" type="text" class="form-control" v-model="EditCusData.sale_price" ><br>
                            <!-- Text role email (client) _______________________ -->

                            <!-- input email modifier (client) _______________________ -->
                            <input v-show="showform(product.id)" type="text" class="form-control" v-model="EditCusData.description" ><br>
                            <!-- input email modifier (client) _______________________ -->

                            <!-- Text username (client) _______________________ -->
                            <span v-show="!showform(product.id)" >description : 
                            {{ product.description.replace(/<[^>]*>/g, '') }} </span>
                            <!-- Text username email (client) _______________________ -->
                            
                        </div>

                  
                        <div class="panel-footer">
                        <!-- bouton ok modifier (client) _______________________ -->
                        <button type="submit" v-show="showform(product.id)" class="btn btn-success btn-rd " style=" float: right;">

                            <span class="glyphicon glyphicon-floppy-saved"  aria-hidden="true"></span>

                        </button>
                        <!-- bouton ok modifier (client) _______________________ -->

                        <!-- bouton annuler modifier (client) _______________________ -->
                        <button @click.prevent="editform=false" v-show="showform(product.id)" class="btn btn-danger btn-rd">

                            <span class="glyphicon glyphicon-menu-left"  aria-hidden="true"></span>

                        </button>
                        <!-- bouton annuler modifier (client) _______________________ -->
                        </div>

                    </form>
                    <!-- button modifier _______________________________________ -->

                </div></div>
                <!-- chargement label _______________________________________ -->

            </div>

        </div>

        <div class="modal fade" id="myModal" style="z-index: 2000;">
          <div class="modal-dialog" id="myModalD" >
            <div class="modal-content">
              <div class="modal-header">
               
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body" style="text-align: center;" >
                <div v-show="!chargement" class="loader"></div>
                <p>  {{ message }} </p>
              </div>
              <div class="modal-footer" v-show="chargement" >
                <button @click="hideAlert()" type="button" class="btn btn-success" >OK</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->




    </div>

</template>







<script>


    export default {


        data() {

            return{ 

                products: [] , 
                allproducts: [],
                loading: false,
                editform: "",
                EditCusData: {
                    name: "", 
                    slug: "",
                    type: "",
                    description: "",
                    sale_price: ""
                },
                chercher: "",
                list: [],
                chargement: false,
                message: 'veuillez patientez ...',
                errors: []

            }

        },




















        methods: {


             afficherAlert(){

                var a = document.getElementById('myModal');
                var b = document.getElementById('myModalD');
                var c = document.getElementById('other');
                b.style.transform = 'translateY(200px)';
                a.style.opacity = 1;
                a.style.display = 'block';
                c.style.display = 'block';
                this.message = 'veuillez patientez ...';
                this.chargement = false;

            },



            hideAlert(){

                var a = document.getElementById('myModal');
                var b = document.getElementById('myModalD');
                var c = document.getElementById('other');
                b.style.transform = 'translateY(-200px)';
                a.style.opacity = 0;
                a.style.display = 'none';
                c.style.display = 'none';


            },











            editthis(id){

                this.products.forEach((product, i)=>{

                    if(product.id == id){

                        this.EditCusData = product

                    }

                });

                return this.editform=id;

            },








            showform(id){

                if(this.editform==id){

                    return true;

                }

                return false;

            },









            update(id){

                this.afficherAlert();

                axios.put('api/products/update/'+id, this.EditCusData ).then((response) => {
                    
                    this.EditCusData = "";
                    this.editform=false;
                    this.message = 'Client modifié avec succée ';
                    this.chargement = true;


                    

                }).catch(error => {

                     this.errors = [];
                    var err = [];
                    for (var str in error.response.data) {
                        err.push(error.response.data[str]);
                    }

                    var txt = '';
                    for(var str in err){

                         
                        err[str][0] = err[str][0].replace('[','');
                        err[str][0] = err[str][0].replace(']','');
                        err[str][0] = err[str][0].replace('"','');
                        err[str][0] = err[str][0].replace('name','Nom');
                        err[str][0] = err[str][0].replace('type','Type');
                        err[str][0] = err[str][0].replace('slug','slug');
                        err[str][0] = err[str][0].replace('short description','description');


                        this.errors.push( err[str][0] );

                    }

                    console.log(err);
                    this.hideAlert();

                });

            },








            supprimer(id) {

                this.afficherAlert();

                axios.delete(`api/products/delete/${id}`).then((response) =>  {
                            
                    this.allproducts.forEach((product, i)=>{

                        if (product.id == id) {

                                this.allproducts.splice(i, 1);

                        }

                    });

                    this.products = [];

                    this.allproducts.forEach((product, i) => {

                        this.products.push(product);

                    });

                    this.message = 'Produit supprimé avec succée ';
                    this.chargement = true;
                                           
                }).catch((error) => {

                        console.log(error)

                })

            },





            refresh() {

                this.afficherAlert();
                axios.get('/api/products/get_all').then((response) => {

                    this.products = response.data; 
                    this.allproducts = this.products; 
                    this.loading = false;
                    this.hideAlert();

                });

            },








            cherch() {

                if(this.chercher === ""){

                    this.refresh();

                }else{

                    this.allproducts.forEach((product, i)=>{

                        if(product.name == this.chercher){

                            this.list.push(product);

                        }

                    });

                    this.products = [];

                    this.list.forEach((product, i) => {

                        this.products.push(product);

                    });

                    this.list = [];

                }

            },

        },


















        mounted() {
           
            this.refresh();

        }, 

        computed: {
            filteredProducts: function () {
                var self = this
                return self.products.filter(function (product) {
                    return (product.name.match(self.chercher.toLowerCase())) || 
                           (product.slug.match(self.chercher.toLowerCase())) ||
                           (product.description.match(self.chercher.toLowerCase())) ||
                           (product.type.match(self.chercher.toLowerCase())); 
                })
            }
        }

    }
</script>


<style type="text/css">
    
    ::-webkit-input-placeholder {
        text-align: center;
    }
</style>


