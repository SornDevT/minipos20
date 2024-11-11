<template lang="">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4" >
                <div class="card-body">
                    <div class="input-group">
          
          <input type="text" class=" form-control" v-model="Search" @keyup.enter="GetStore()" placeholder="ຄົ້ນຫາສິນຄ້າ...">
          <button class="btn btn-primary p-2" type="button" @click="GetStore()" ><i class='bx bx-search-alt'></i></button>
        </div>

                    
                </div>
            </div>
            <PerfectScrollbar>
                <div style="height:65vh">
                <div class="row">
                    <div class="col-md-3 mb-4" v-for=" item in StoreData.data " :key="item.id" >
                        <div class="card h-100 cursor-pointer" style=" position:relative; " @click="AddProduct(item.id)" >
                            <!-- <span v-for="i in ListOrder" :key="i.id"> 
                                <span v-if="i.id == item.id" class="box-list">{{ i.qty }}</span>
                            </span> -->
                            <span v-if="ListQty(item.id)" class="box-list">{{ ListQty(item.id) }}</span>

                            <img class="card-img-top pos-img " v-if="item.image" :src="url + '/assets/img/'+ item.image" alt="Card image cap">
                            <img class="card-img-top pos-img " v-else :src="url + '/assets/img/no-img.jpg'" alt="Card image cap">
                            <div class="card-body p-1 text-center">
                                <h5 class="card-title"> {{ item.name }} </h5>
                                <p class="card-text ">{{ formatPrice(item.price_sell) }} ກີບ</p>
                                
                            </div>
                            </div>
                    </div>
                </div>
            </div>
            </PerfectScrollbar>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                        <label>ຊື່ລູກຄ້າ:</label>
                        <input type="text" class=" form-control mb-1" placeholder="..." >
                        <label>ເບີໂທ:</label>
                        <input type="text" class=" form-control mb-1" placeholder="..." >
                    </div>
                    <div class=" p-2 bg-info text-white">
                        ລາຍການສັ່ງຊື້
                    </div>
                    <PerfectScrollbar>
                    <div style=" height:42vh">
                        <table class="table table-bordered ">
                            <tbody>
                                <tr v-for="item in ListOrder" :key="item.id">
                                    <td class="p-1 d-flex ">
                                        <img v-if="item.image" :src="url + '/assets/img/'+item.image" class="list-img">
                                        <img v-else :src="url + '/assets/img/no-img.jpg'" class="list-img">
                                        <div class=" ms-2 w-100 pe-2">
                                             <span> {{ item.name }} </span>
                                             <div class=" text-end">{{ formatPrice(item.qty) }} x {{ formatPrice(item.price) }}</div>
                                             <div class=" d-flex justify-content-between"> 
                                                <span><i class='bx bxs-plus-circle fs-5 text-info cursor-pointer' @click="AddProduct(item.id)"></i> | <i class='bx bxs-minus-circle fs-5 text-warning cursor-pointer' @click="RemoveProduct(item.id)"></i> | <i class='bx bxs-trash fs-5 text-danger cursor-pointer' @click="DelProduct(item.id)"></i></span>
                                                <span>{{ formatPrice(item.qty*item.price) }}</span>
                                             </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </PerfectScrollbar>
                        <div class="p-2 bg-info text-white d-flex justify-content-between">
                            <span>ລວມຍອດເງິນ:</span>
                            <span> {{ formatPrice(TotalAll) }} ກີບ</span>
                        </div>
                        <div class=" p-2">
                            <button type="button" :disabled="!TotalAll" class="btn rounded-pill btn-success w-100 ">ຊຳລ່ະເງິນ</button>
                        </div>
                </div>
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
            url: window.location.origin,
            StoreData:[],
            ListOrder:[],
            Sort:'desc',
            PerPage: 50,
            Search:'',
        }
    },
    computed:{
        TotalAll(){
            let val = this.ListOrder.reduce( (num, item) => parseInt(num)+(parseInt(item.qty)*parseInt(item.price)),0);
            return val;
        }
    },
    methods:{
        ListQty(id){
           let qt = this.ListOrder.find((i)=>i.id == id)
           if(qt){
            return qt.qty
           } else {
            return 0
           }
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        GetStore(page){

            axios.get(`api/store?page=${page}&sort=${this.Sort}&perpage=${this.PerPage}&search=${this.Search}`,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{

                this.StoreData = res.data;

            }).catch((error)=>{
                // console.log(error)
                console.log(error)
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

            },
            AddProduct(id){
                
                let item = this.StoreData.data.find((i)=>i.id == id)
                let old_item = this.ListOrder.find((i)=>i.id == id)
                // console.log(item)
                if(item.qty>0){
                    if(old_item){

                        if(item.qty - old_item.qty>0){
                            // ມີລາຍການແລ້ວ ເພີ່ມຈຳນວນ
                            old_item.qty++
                        } else {
                            this.$swal({
                                        title:"ບໍ່ສາມາດຂາຍສິນຄ້າໄດ້!",
                                        text:"ສິນຄ້າດັ່ງກ່າວໄດ້ໝົດແລ້ວ!",
                                        showConfirmButton: false,
                                        icon:"error",
                                        timer:3500
                                    });
                        }
                        

                    } else {
                        /// ເພີ່ມລາຍການເຂົ້າໄປໃໝ່
                        this.ListOrder.push({
                            id: item.id,
                            name: item.name,
                            image:item.image,
                            qty: 1,
                            price: item.price_sell

                        })
                    }
                } else {
                    this.$swal({
                                        title:"ບໍ່ສາມາດຂາຍສິນຄ້າໄດ້!",
                                        text:"ສິນຄ້າດັ່ງກ່າວໄດ້ໝົດແລ້ວ!",
                                        showConfirmButton: false,
                                        icon:"error",
                                        timer:3500
                                    });
                }

                

                
            },
            RemoveProduct(id){
                let item = this.ListOrder.find((i)=>i.id == id)

                if(item){
                    item.qty--
                    if(item.qty<1){
                        this.ListOrder.splice(this.ListOrder.map((i)=>i.id).indexOf(id),1)
                    }
                }

            },
            DelProduct(id){
                

                this.$swal({
            title: "ທ່ານແນ່ໃຈບໍ່?",
            text: "ທີ່ຈະລຶບຂໍ້ມູນນີ້!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ຍືນຍັນລຶບ!",
            cancelButtonText:"ຍົກເລີກ"
            }).then((result) => {
            if (result.isConfirmed) {

                this.ListOrder.splice(this.ListOrder.map((i)=>i.id).indexOf(id),1)

                this.$swal({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                        timer:1200
                    });
                
                
            }
            });

            }
    },
    created(){
        this.GetStore()
    },
    watch:{
        Search(){
            if(this.Search==''){
                this.GetStore()
            }
        }
    }
}
</script>
<style scoped>
    .list-img{
        width: 70px;
    height: 70px;
    object-fit: cover;
    object-position: center;
    border: 1px solid #dbdada;
    padding: 2px;
    border-radius: 5px;
    }

    .pos-img{
        width: 100%;
    height: 90px;
    object-fit: cover;
    object-position: center;
    }
    .box-list{
            position: absolute;
    right: 0px;
    background-color: brown;
    color: white;
    padding: 3px;
    border-radius: 0px 6px;
    }
</style>