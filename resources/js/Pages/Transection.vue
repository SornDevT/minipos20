<template lang="">
    <div class="card">
  <h5 class="card-header">ການເຄື່ອນໄຫວ</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
        <div class=" d-flex justify-content-between mb-2">
            <div class=" d-flex">
                <div class=" d-flex align-items-center me-2 cursor-pointer " @click="ChangeSort()" >
                    <i class='bx bx-sort-down fs-3' v-if="Sort=='desc'"></i>
                    <i class='bx bx-sort-up fs-3' v-if="Sort=='asc'"></i>
                </div>
                
                <select v-model="PerPage" class=" form-select" @change="GetTran()" >
                    <option value="5" >5</option>
                    <option value="10" >10</option>
                    <option value="20" >20</option>
                    <option value="30" >30</option>
                </select>
            </div>
            <div class=" d-flex">
              
                <div class="btn-group me-2" role="group" >
                    <button type="button" class="btn btn-secondary" @click="month_type='m'" > <i class='bx bx-chevron-right' v-if="month_type=='m'"></i> ເດືອນ</button>
                    <button type="button" class="btn btn-secondary" @click="month_type='y'" > <i class='bx bx-chevron-right' v-if="month_type=='y'" ></i> ປີ</button>
                </div>
                <input type="date" v-model="dmy" class=" form-control">
            </div>
        </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ວັນທີ່</th>
            <th>ເລກທີ່ທຸລະກຳ</th>
            <th>ປະເພດທຸລະກຳ</th>
            <th>ລາຍລະອຽດ</th>
            <th>ມູນຄ່າ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in TranData.data" :key="item.id">
            <td>{{ date(item.created_at) }}</td>
            <td>{{ item.tran_id }}</td>
            <td>{{ item.tran_type }}</td>
            <td>{{ item.detail }}</td>
            <td class="text-end">{{ formatPrice(item.price) }}</td>
          </tr>
        </tbody>
      </table>
      <Pagination :pagination="TranData" :offset="4" @paginate="GetTran($event)" />
    </div>
  </div>
</div>
</template>
<script>
import axios from 'axios';
import { useStore } from '../Store/auth';
import moment from 'moment';
export default {
    setup(){

const store = useStore()
return { store }

},
    data() {
        return {
            Sort:"desc",
            PerPage: 10,
            month_type:'m',
            dmy: new Date().toISOString().slice(0,10),
            TranData:[],
        }
    },
    components:{
        moment
    },
    methods:{
        date(value){
            return moment(value).format("DD/MM/YYYY");
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        ChangeSort(){
            if(this.Sort == 'asc'){
                this.Sort = 'desc'
            } else {
                this.Sort = 'asc'
            }
            this.GetTran()
        },
        GetTran(page){
                axios.post(`api/transection?page=${page}&perpage=${this.PerPage}&sort=${this.Sort}`,{
                    month_type: this.month_type,
                    dmy: this.dmy
                },{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{
                    this.TranData = res.data
                }).catch((error)=>{
                    if( typeof error.response !=='undefined'){
                            if(error.response.status== 401){

                                // ເຄີຍຂໍ້ມູນໃນ localstorage
                                localStorage.removeItem("web_token")
                                localStorage.removeItem("web_user")

                                // ເຄຍ token ໃນ pinia
                                this.store.remove_token()
                                this.store.remove_user()

                                // go to login
                                this.$router.push("/login")
                                
                            } else {
                                this.$swal({
                                        title: "ມີຂໍ້ຜິດຜາດ!",
                                        text: error.response.data.message,
                                        icon: "error"
                                    });
                            }
                            
                        }
                })
        }
    },
    created(){
        this.GetTran()
    },
    watch:{
        month_type(){
            this.GetTran()
        },
        dmy(){
            this.GetTran()
        }
    }
}
</script>
<style lang="">
    
</style>