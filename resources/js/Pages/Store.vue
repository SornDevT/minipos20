<template lang="">
    <div class="card">
  <h5 class="card-header">ລາຍການ ສະຕ໋ອກສິນຄ້າ</h5>
  <div class="card-body">

    <div v-if="ShowForm">
        {{ FormStore }}
        <div class="row">
            <div class="col-md-4">Image</div>
            <div class="col-md-8">
                <div class="mb-2">
                    <label  class="form-label">ຊື່ສິນຄ້າ:</label>
                    <input type="text" class="form-control" v-model="FormStore.name"  placeholder="..." >
                </div>
                <div class="mb-2">
                    <label  class="form-label">ຈຳນວນ:</label>
                    <input type="text" class="form-control" v-model="FormStore.qty"  placeholder="..." >
                </div>
                <div class="row">
                    <div class=" col-md-6 mb-2">
                        <label  class="form-label">ລາຄາຊື້:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="FormStore.price_buy" placeholder="..." >
                            <span class="input-group-text" id="basic-addon11">ກີບ</span>
                        </div>

                    </div>
                    <div class="col-md-6 mb-2">
                        <label  class="form-label">ລາຄາຂາຍ:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="FormStore.price_sell"  placeholder="..." >
                            <span class="input-group-text" id="basic-addon11">ກີບ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-end ">
            <button type="button" class="btn btn-success me-2" :disabled="CheckForm" @click="SaveStore()" >ບັນທຶກ</button>
            <button type="button" class="btn btn-warning" @click="CancelStore()">ຍົກເລີກ</button>
        </div>
    </div>

    <div class="table-responsive text-nowrap" v-else>
        <div class=" d-flex justify-content-between mb-2">
            <div class=" d-flex">
                <div class=" d-flex align-items-center me-2 ">
                    <i class='bx bx-sort-down fs-3'></i>
                </div>
                
                <select class=" form-select">
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>30</option>
                </select>
            </div>
            <div class=" d-flex">
                <div class="input-group me-2">
                    <input type="text" class="form-control" placeholder="ຄົ້ນຫາ...">
                    <button class="btn btn-primary p-2 " type="button" ><i class='bx bx-search-alt fs-5'></i></button>
                </div>
                <button type="button" class="btn btn-info" @click="AddStore()" >ເພີ່ມຂໍ້ມູນ</button>
            </div>
        </div>
        <!-- {{ StoreData }} -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>ຮູບພາບ</th>
            <th>ຊື່ສິນຄ້າ</th>
            <th>ຈຳນວນ</th>
            <th>ລາຄາຊື້</th>
            <th>ຈັດການ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for=" item in StoreData.data" :key="item.id" >
            <td> {{ item.id }} </td>
            <td>{{ item.image }}</td>
            <td>{{ item.name }}</td>
            <td>
             {{ item.qty }}
            </td>
            <td>{{ item.price_buy }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);" @click="EditStore(item.id)" ><i class="bx bx-edit-alt me-1"></i> ແກ້ໄຂ</a>
                  <a class="dropdown-item" href="javascript:void(0);" @click="DelStore(item.id)" ><i class="bx bx-trash me-1"></i> ລຶບ</a>
                </div>
              </div>
            </td>
          </tr>
         
          
        </tbody>
      </table>

      <Pagination :pagination="StoreData" :offset="4" @paginate="GetStore($event)" />
    </div>


  </div>
</div>
</template>
<script>
import axios from 'axios';
import { useStore } from '../Store/auth'

export default {
    setup(){

        const store = useStore()
        return { store }

    },
    data() {
        return {
            ShowForm: false,
            FormType: true,
            StoreData:[],
            EditID:'',
            FormStore: {
                name:'',
                image:'',
                qty:'',
                price_buy:'',
                price_sell:''
            }
        }
    },
    computed:{
        CheckForm(){
            if(this.FormStore.name == '' || this.FormStore.qty == '' || this.FormStore.price_buy == '' || this.FormStore.price_sell == ''){
                return true
            } else {
                return false
            }
        }
    },
    methods:{
        AddStore(){
            this.ShowForm = true
            this.FormType = true
        },
        CancelStore(){
            this.ShowForm = false
        },
        EditStore(id){
            this.EditID = id
            this.FormType = false

            axios.get(`api/store/edit/${id}`,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{

                this.FormStore = res.data
                // ສະແດງຟອມ
                this.ShowForm = true

            }).catch((error)=>{
                console.log(error)
            })
        },
        DelStore(id){

            axios.delete(`api/store/delete/${id}`,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{
                if(res.data.success){
                    // ອັບເດດລາຍການ
                    this.GetStore()
                } else {

                }
            }).catch((error)=>{
                console.log(error)
            })
        },
        SaveStore(){

            if(this.FormType){
                // ເພີ່ມຂໍ້ມູນໃໝ່

                axios.post('api/store/add',this.FormStore,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{

                    // console.log(res)

                        if(res.data.success){

                            this.FormStore.name = ''
                            this.FormStore.image = ''
                            this.FormStore.qty = ''
                            this.FormStore.price_buy = ''
                            this.FormStore.price_sell = ''

                            // ປິດຟອມ
                            this.ShowForm = false

                            // ອັບເດດລາຍການ
                            this.GetStore()

                        } else {
                            
                        }

                    }).catch((error)=>{
                    console.log(error)
                    })

            } else {

                // ອັບເດດຂໍ້ມູນ
                axios.post(`api/store/update/${this.EditID}`, this.FormStore,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{
                  
                    if(res.data.success){

                        this.FormStore.name = ''
                            this.FormStore.image = ''
                            this.FormStore.qty = ''
                            this.FormStore.price_buy = ''
                            this.FormStore.price_sell = ''

                            // ປິດຟອມ
                            this.ShowForm = false

                            // ອັບເດດລາຍການ
                            this.GetStore()

                    } else {

                    }

                }).catch((error)=>{
                    console.log(error);
                })

            }

            
        },
        GetStore(page){

            axios.get(`api/store?page=${page}`,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{

                this.StoreData = res.data;

            }).catch((error)=>{
                console.log(error)
            })

        }
    },
    created(){
        this.GetStore()
    }
}
</script>
<style lang="">
    
</style>