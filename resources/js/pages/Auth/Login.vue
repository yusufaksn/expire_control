<template>
    <div>
        <div class="container">
            <br>
            <div class="alert alert-danger" v-if="errorMessage">
                {{errorMessage}}
            </div>
          <div class="row">
              <div class="col-9">
                  <h1>Login</h1>
              </div>
              <div class="col">
                  <button class="btn btn-success" @click="register">Register</button>
              </div>
          </div>
            <hr>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" v-model="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" v-model="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary" @click="login()">Login</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login-page",
        data () {
            return {
                email: '',
                password: '',
                item:[],
                headers: {},
                errorMessage:""
            }
        },

        methods: {
            login() {
                this.item = [];
                this.item.push({
                    'email': this.email,
                    'password': this.password
                });
                if (!this.email && !this.password) {
                    this.errorMessage = "Username and password fields cannot be left blank";
                } else {
                    axios.post('login', this.item)
                        .then((res) => {
                            if (res.data.status === true) {
                                this.$router.push({name: 'product'});
                            }
                        })
                        .catch(err => {
                            if (err) {
                                this.errorMessage = "username or password is wrong!";
                            }
                        })
                }
            },
            register(){
                this.$router.push({name: 'register'});
            }
        }
    }
</script>
