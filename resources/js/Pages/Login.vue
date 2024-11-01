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
              <span class="app-brand-text demo text-heading fw-bold">sneat</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">ສະບາຍດີ! 👋</h4>
          <p class="mb-6">ກະລຸນາເຂົ້າສູ່ລະບົບ</p>

       
            <div class="mb-6">
              <label for="email" class="form-label">ອີເມວລ໌:</label>
              <input type="text" v-model="email" class="form-control" id="email" name="email-username" placeholder="Enter your email" autofocus="">
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
              <div class="input-group input-group-merge">
                <input type="password" v-model="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-8">
              <div class="d-flex justify-content-between mt-8">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" v-model="remember_me" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    ຈື່ຂ້ອຍໄວ້
                  </label>
                </div>
              
              </div>
            </div>
            <div class="alert alert-warning" role="alert" v-if="text_error || check_email_text || check_pass_text" >
              {{ text_error }} {{ check_email_text }} {{ check_pass_text }}
            </div> 
            <div class="mb-6"> 
              <button class="btn btn-primary d-grid w-100" :disabled="CheckForm" @click="Login()" >ເຂົ້າສູ່ລະບົບ</button>
            </div>
         

          <p class="text-center">
            <span>ບໍ່ມີຊື່ຜູ້ໃຊ້!</span>
            <router-link to="/register">
              <span>ລົງທະບຽນ</span>
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
        email:'',
        password:'',
        remember_me: false,
        text_error:'',
        check_email_text:'',
        check_pass_text:''
      }
    },
    computed:{
      CheckForm(){

        // ການກວດຊອບ ອີເມວລ໌
         const EmailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

         if(this.email){
            if(EmailRegex.test(this.email)){
              this.check_email_text = ''
            } else {
              this.check_email_text = 'ອີເມວລ໌ບໍ່ຖຶກຕ້ອງ'
            }
         } else {
          this.check_email_text = ''
         }

         // ກວດລະຫັດຜ່ານ ຕ້ອງຫຼາຍກ່ວາ 5 ຕົວອັກສອນ
         if(this.password){
          if(this.password.length <=5){ // exp: .length = abcd = 4
            this.check_pass_text = 'ລະຫັດຜ່ານຕ້ອງຫຼາຍກວ່າ 5 ຕົວອັກສອນ'
          } else {
            this.check_pass_text = ''
          }
         } else {
          this.check_pass_text = ''
         }

         // ກວດຊອບຄວາມຖຶກຕ້ອງ ແລ້ວສະແດງປຸ່ມ
         if(!EmailRegex.test(this.email) || this.password.length <=5){
          return true
         } else {
          return false
         }

          // if(this.email == '' || this.password ==''){
          //   return true;
          // } else {
          //   return false;
          // }
      }
    },
    methods:{
      Login(){
          if(this.email !='' && this.password !=''){
              axios.post('api/login',{
                 login_email: this.email,
                 login_password: this.password,
                 login_remember_me: this.remember_me
              }).then((res)=>{

                //console.log(res)
                if(res.data.success){
                  this.text_error = ''

                  // clear form data
                  this.email = ''
                  this.password = ''

                  // ບັນທຶກຂໍ້ມູນລົງໃນ localstorage

                  localStorage.setItem('web_token', res.data.token)
                  localStorage.setItem('web_user', JSON.stringify(res.data.user_data))

                  // go to root path
                  this.$router.push('/')

                } else {
                  this.text_error = res.data.message
                }

              }).catch((error)=>{
                console.log(error)
              })
          } 
      }
    }
}
</script>
<style lang="">
    
</style>