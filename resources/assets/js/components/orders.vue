<template>
    <div class="container">

    <h3> liste des orders </h3>

    <div class="row pull-right">
        <router-link to="create" >
            <a class="btn btn-success" >Ajouter un Order</a>
        </router-link>
    </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div v-if="loading" > loading ... </div>



                    <!--

                    <div class="panel panel-default" v-for="book in Books" >

                        <div v-show="!showform(book.id)"  @click="editthis(book.id)" class="btn btn-default pull-right"> edit </div>        
                               <div v-show="!showform(book.id)"  class="btn btn-default pull-right "> delete </div>

                        <form @submit.prevent="update(book.id)" >

                        <div class="panel-heading">
                            
                            <h3 style="width: 200px" v-show="!showform(book.id)" > {{ book.titre }} </h3>

                            <input style="width: 200px" v-show="showform(book.id)" type="text" class="form-control" v-model="editbookdata.titre" >                                

                        </div>

                        <div class="panel-body">

                            <span v-show="!showform(book.id)" > {{ book.description }} </span>

                            <input v-show="showform(book.id)" type="text" class="form-control" v-model="editbookdata.description" > 

                        </div>

                        <button v-show="showform(book.id)" class="btn btn-success">modifier</button>
                        <button @click.prevent="editform=false" v-show="showform(book.id)" class="btn btn-success">annuler</button>
                        </form>
                    </div>

                    -->

                
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {

            return{ 

                Books: [] , 
                loading: false,
                editform: "",
                editbookdata: {titre: "", description: ""}
            }

        },

        methods: {

            editthis(id){

                return this.editform=id;
            },
            showform(id){
                if(this.editform==id){
                    return true;
                }
                return false;
            },
            update(id){

                var a = document.getElementById('h');
                var b = a.getAttribute('content');

                axios.defaults.headers.common['X-CSRF-TOKEN'] = b ;

                axios.put('/book/'+id, this.editbookdata ).then((response) => {
                    this.editbookdata = "";
                    this.editform=false;
                    this.$router.push('/home');

                }).catch(error => {
                    console.log(error.response);
                    this.errors = error.response.data;
                });
            }

        },

        mounted() {

            this.loading = true;
            axios.get('/book').then((response) => {

                this.Books = response.data; 
                this.loading = false;
            });

        }

    }
</script>
