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
              <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email" autofocus="">
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-8">
              <div class="d-flex justify-content-between mt-8">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    ຈື່ຂ້ອຍໄວ້
                  </label>
                </div>
              
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" >ເຂົ້າສູ່ລະບົບ</button>
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
export default {
    
}
</script>
<style lang="">
    
</style>