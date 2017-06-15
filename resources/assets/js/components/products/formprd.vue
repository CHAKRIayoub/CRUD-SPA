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
           ">
                
        </div>

        <div class="row" >

            <div class="col-md-6 col-md-offset-3">
            <form @submit.prevent="addProduct" >

                
                <div class="panel panel-default"  >
            <div class="panel-body">


                        <h3 class="bg-success" > Ajouter Un Produit : </h3> 



                        

                        <div class="alert alert-danger" v-for="error in errors" >
                        <button onclick="this.parentElement.style.display = 'none';" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ error }} 
                        </div>

                            <div class="form-group"> 
                                <label for="" >Nom</label>
                                <input type="text" class="form-control" id="" placeholder="" v-model="productdata.name" >
                            </div>

                            <div class="form-group">
                                <label for="" >Slug</label>
                                <input type="text" class="form-control" id="" placeholder="" v-model="productdata.slug">
                            </div>

                            <div class="form-group">
                                <label for="" >description</label>
                                <input type="text" class="form-control" id="" placeholder="" v-model="productdata.description">
                            </div>

                            <div class="form-group">
                                <label for="" >type</label>
                                <select class="form-control" v-model="productdata.type" >
                                  <option>simple</option>
                                  <option>grouped</option>
                                  <option>external</option>
                                  <option>variable</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="" >prix</label> 
                                <input type="text" class="form-control" id="" placeholder="" v-model="productdata.sale_price">
                            </div>

                         

                        
                       
                   
                   </div>
                
                </div>



                 <div class="">
                           <button type="submit" class="btn btn-success btn-rd pull-right">
                                <span class="glyphicon glyphicon-floppy-saved"  aria-hidden="true"></span>
                            </button>

                            <button @click="retour()" class="btn btn-primary btn-rd">
                                <span class="glyphicon glyphicon-menu-left"  aria-hidden="true"></span>
                            </button>
                    </div>
                    </form>
            
            </div>
        
        </div>




 



<!--fade change opacity
transform: translate(0, -25%);-->



<div class="modal fade" id="myModal" style="z-index: 2000;  transition: opacity 1s ease;"  >
  <div class="modal-dialog" id="myModalD" >
    <div class="modal-content">
      <div class="modal-header"><!--
        <button v-show="btnclose" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" style="text-align: center;" >

        <div v-show="!chargement" class="loader"></div>
        <p>  {{ message }} </p>

      </div>
      <div class="modal-footer" v-show="chargement" >
        <button @click="retour()" type="button" class="btn btn-success" >OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->














    
    </div>


</template>

<script>
    export default {

        data(){

            return {

                productdata:{
                    slug: '',
                    name: '',
                    sale_price: '',
                    type: '',
                    description: ''
                },
               
                errors: {},

                message: ' veuillez patientez ... ',

                chargement: false

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
                c.style.display = 'block'

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

            addProduct(){

                this.afficherAlert();
                axios.post('api/products/add', this.productdata).then((response) => {

                    this.productdata = "";
                    this.errors = "";
                    this.message = 'Produit ajouter avec succée ';
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
                        err[str][0] = err[str][0].replace('name','" nom "');
                        err[str][0] = err[str][0].replace('sale price','prix');
                        err[str][0] = err[str][0].replace('type','type');

                        this.errors.push( err[str][0] );

                    }

                    console.log(err);
                    this.hideAlert();




                });
                
                
            },

            retour() {
                this.$router.push('/p');
            }


           
        },

       
        

        mounted() {

            /*

            this.loading = true;
            axios.get('/book').then((response) => {

                this.Books = response.data; 
                this.loading = false;
            });

            */

        }

    }
</script>


<style>
    .loader {
        border: 5px solid #2196f3; /* f3f3f3 Light grey */
        border-top: 5px solid #fff; /* 3498db Blue */
        background: #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 0.8s linear infinite;
        margin: 5px auto;
    }

    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .btn-rd{
        margin :auto 6px;
        border-radius: 50%;   
        width: 60px;
        height: 60px;
        text-align: center;
        font-size: 30px;
    }
</style>
