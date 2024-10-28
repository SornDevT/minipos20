<template lang="">
    <div class=" row d-flex justify-content-center ">
        <div class="authentication-wrapper authentication-basic container-p-y col-md-4">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">



</span>
      
            </a>
          </div>
          <!-- /Logo -->
          <h3>ລົງທະບຽນ ສະມາຊິກໃໝ່</h3>
     
            <div class="mb-6"> 
              <label for="user_name" class="form-label">ຊື່ຜູ້ໃຊ້:</label>
              <input type="text" class="form-control" id="user_name" v-model="user_name"  placeholder="...." >
            </div>
            <div class="mb-6">
              <label for="email" class="form-label">ອີເມວລ໌:</label>
              <input type="text" class="form-control" id="email" name="email-username" v-model="user_email" placeholder="...." >
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" v-model="password" placeholder="············" aria-describedby="password">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">ຍືນຍັນ ລະຫັດຜ່ານ:</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" v-model="password2" placeholder="············" aria-describedby="password">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="alert alert-warning" role="alert" v-if="text_error" >
              {{ text_error }}
            </div>

            <div class="mb-6">
              <button @click="Register()" class="btn btn-primary d-grid w-100" >ລົງທະບຽນ</button>
            </div>
          

          <p class="text-center">
            <span>ມີຊື່ຜູ້ໃຊ້ແລ້ວ!</span>
            <router-link to="/login">
              <span>ເຂົ້າສູ່ລະບົບ</span>
            </router-link>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
    </div>
</template>
<script>

import axios from 'axios';

export default {
    data() {
      return {
        user_name:'',
        user_email:'',
        password:'',
        password2:'',
        text_error:''
      }
    },
    methods:{
      Register(){

        if(this.user_name == '' || this.user_email == '' || this.password == '' ){
          this.text_error = 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບຖ້ວນ!';
        } else {

          if(this.password == this.password2){
              this.text_error = '';

              axios.post('api/register',{
                form_user_name : this.user_name,
                form_user_email: this.user_email,
                form_passwprd: this.password
              }).then((res)=>{
                 
                console.log(res)

                if(res.data.success){

                  
                  this.text_error = '';
                  // ເຄຍຂໍ້ມູນໃນຟອມ
                  this.user_name = '';
                  this.user_email = '';
                  this.password = '';
                  this.password2 = '';
                  // go to login
                  this.$router.push("/login");


                } else {
                  this.text_error = res.data.message;
                }

              }).catch((error)=>{

                console.log(error)

              })

          } else {
            this.text_error = "ລະຫັດຜ່ານບໍ່ກົງກັນ";
          }
        }


      }
    }

}
</script>
<style lang="">
    
</style>