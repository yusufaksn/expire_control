<template>
    <div class="container">
        <br>
        <div class="alert alert-danger" v-if="errorMessage">
            {{errorMessage}}
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" v-model="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email">
        </div>

        <div class="form-group">
            <label >Password</label>
            <input type="password" class="form-control" id="pass1" v-model="pass1">
        </div>

        <div class="form-group">
            <label >Password</label>
            <input type="password" class="form-control" id="pass2" v-model="pass2">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>

        <button type="submit" class="btn btn-primary" @click="register">Save</button>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data(){
            return{
                pass1:"",
                pass2:"",
                errorMessage:"",
                email:"",
                name:""
            }
        },
        methods:{
            register(){
                this.item = [];
                this.item.push({
                    'email': this.email,
                    'password': this.pass1,
                    'name': this.name,
                });
                if(this.pass1 != this.pass2){
                    this.errorMessage = "Passwords do not match";
                }else{
                    axios.post('user-store',this.item[0]).then(response => {
                        alert("Kayıt işlemi başarı ile gerçekleşmiştir.")
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
