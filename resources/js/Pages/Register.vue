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
              <input type="text" class="form-control" id="user_name"  placeholder="Enter your name" >
            </div>
            <div class="mb-6">
              <label for="email" class="form-label">ອີເມວລ໌:</label>
              <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email" >
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">ຍືນຍັນ ລະຫັດຜ່ານ:</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" >ລົງທະບຽນ</button>
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
export default {
    
}
</script>
<style lang="">
    
</style>