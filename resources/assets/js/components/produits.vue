<template>


    <div class="container">

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

        <div class="pull-left">

            <h3> liste des clients :</h3><br><br>

        </div>

        <div class="row pull-right">
            <router-link to="createClient" >

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
            <div class="col-md-8 col-md-offset-2">
               
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
                <div style="padding: 15px"  v-for="customer in filteredCustomers" >
              <div class="panel panel-default">

                <div class="panel-heading">

                    <!-- button modifier _______________________________________ -->
                        <div  v-show="!showform(customer.id)"  @click="editthis(customer.id)" class="btn btn-primary pull-right btn-rd"  >
                             
                             <span class="glyphicon glyphicon-pencil"  aria-hidden="true"></span>
                             

                        </div> 
                        <!-- button modifier _______________________________________ -->

                        <!-- button supprimer _______________________________________ -->
                        <div v-show="!showform(customer.id)"  @click="supprimer(customer.id)"  class="btn btn-danger pull-right btn-rd"    >
                                
                            <span class="glyphicon glyphicon-trash"  aria-hidden="true"></span>
                                 

                        </div>
                    </div>

                
                    <!-- button supprimer _______________________________________ -->

                    <!-- form modifier _______________________________________ -->
                    <form @submit.prevent="update(customer.id)" >

                        <div class="panel-body">
                            
                            <!-- label Nom Prenom (client) _______________________________ -->
                            <h5 style="width: 400px" v-show="!showform(customer.id)" > 
                            {{ customer.first_name }} {{ customer.last_name }} </h5>
                            <!-- Text Nom Prenom (client) _______________________________ -->

                            <div v-show="showform(customer.id)" class="alert alert-danger" v-for="error in errors" >
                                <button onclick="this.parentElement.style.display = 'none';" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{ error }} 
                            </div>

                            <!-- input Nom Prenom modifier (client) _______________________ -->
                            <input style="width: 400px" v-show="showform(customer.id)" type="text" class="form-control" v-model="EditCusData.first_name" >
                            <input style="width: 400px" v-show="showform(customer.id)" type="text" class="form-control" v-model="EditCusData.last_name" >
                            <!-- input Nom Prenom modifier (client) _________________________ -->                                
                       

                            <!-- Text role email (client) _______________________ -->
                            <span v-show="!showform(customer.id)" >role : {{ customer.role }} </span>

                            <br>
                           
                            <span v-show="!showform(customer.id)" >E-mail : {{ customer.email }} </span>
                            <!-- Text role email (client) _______________________ -->

                            <!-- input email modifier (client) _______________________ -->
                            <input v-show="showform(customer.id)" type="email" class="form-control" v-model="EditCusData.email" ><br>
                            <!-- input email modifier (client) _______________________ -->

                            <!-- Text username (client) _______________________ -->
                            <span v-show="!showform(customer.id)" >Nom d'utilisateur : 
                            {{ customer.username }} </span>
                            <!-- Text username email (client) _______________________ -->
                            
                        </div>

                  
                        <div class="panel-footer">
                        <!-- bouton ok modifier (client) _______________________ -->
                        <button type="submit" v-show="showform(customer.id)" class="btn btn-success btn-rd " style=" float: right;">

                            <span class="glyphicon glyphicon-floppy-saved"  aria-hidden="true"></span>

                        </button>
                        <!-- bouton ok modifier (client) _______________________ -->

                        <!-- bouton annuler modifier (client) _______________________ -->
                        <button @click.prevent="editform=false" v-show="showform(customer.id)" class="btn btn-danger btn-rd">

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

                customers: [] , 
                allcustomers: [],
                loading: false,
                editform: "",
                EditCusData: {
                    first_name: "", 
                    last_name: "",
                    email: "",
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

                this.customers.forEach((customer, i)=>{

                    if(customer.id == id){

                        this.EditCusData = customer

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

                axios.put('api/customers/update/'+id, this.EditCusData ).then((response) => {
                    
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
                        err[str][0] = err[str][0].replace('first name','Prenom');
                        err[str][0] = err[str][0].replace('last name','Nom');
                        err[str][0] = err[str][0].replace('username','Nom d\'utilisateur');

                        this.errors.push( err[str][0] );

                    }

                    console.log(err);
                    this.hideAlert();

                });

            },








            supprimer(id) {

                this.afficherAlert();

                axios.delete(`api/customers/delete/${id}`).then((response) =>  {
                            
                    this.allcustomers.forEach((customer, i)=>{

                        if (customer.id == id) {

                                this.allcustomers.splice(i, 1);

                        }

                    });

                    this.customers = [];

                    this.allcustomers.forEach((customer, i) => {

                        this.customers.push(customer);

                    });

                    this.message = 'Client supprimé avec succée ';
                    this.chargement = true;
                                           
                }).catch((error) => {

                        console.log(error)

                })

            },





            refresh() {

                this.afficherAlert();
                axios.get('/api/customers/get_all').then((response) => {

                    this.customers = response.data; 
                    this.allcustomers = this.customers; 
                    this.loading = false;
                    this.hideAlert();

                });

            },








            cherch() {

                if(this.chercher === ""){

                    this.refresh();

                }else{

                    this.allcustomers.forEach((customer, i)=>{

                        if(customer.first_name == this.chercher){

                            this.list.push(customer);

                        }

                    });

                    this.customers = [];

                    this.list.forEach((customer, i) => {

                        this.customers.push(customer);

                    });

                    this.list = [];

                }

            },

        },


















        mounted() {
           
            this.refresh();

        }, 

        computed: {
            filteredCustomers: function () {
                var self = this
                return self.customers.filter(function (customer) {
                    return (customer.first_name.match(self.chercher)) || 
                           (customer.last_name.match(self.chercher)) ||
                           (customer.email.match(self.chercher)) ||
                           (customer.username.match(self.chercher)); 
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


