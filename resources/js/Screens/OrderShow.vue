<template>
    <v-container>
        <v-card style="margin-bottom:15px;">
            <v-card-title primary-title>
                Order Details
            </v-card-title>
            <v-card>
                <v-card-text>
                    ID:{{order.id}}
                </v-card-text>
                <v-card-text>
                    Total:{{order.total}}
                </v-card-text>
                <v-card-text>
                    Payment:{{order.payment}}
                </v-card-text>
                <v-card-text>
                    Time:{{order.time}}
                </v-card-text>
                <v-card-text>
                    Note:{{order.note}}
                </v-card-text>
                <v-card-text>
                    Status:
                    <div v-if="order.status == 0" style="color:blue;">
                        Not Approve
                    </div>
                     <div v-if="order.status == 1" style="color:blue;">
                        In Process
                    </div>
                    <div v-if="order.status == 2" style="color:green;">
                        Complete
                    </div>
                </v-card-text>
            </v-card>
        </v-card>
        <v-card style="margin-bottom:15px;">
            <v-card-title primary-title>
                Order User
            </v-card-title>
            <v-card>
                <v-card-text>
                    ID:{{user.id}}
                </v-card-text>
                <v-card-text>
                    Name:{{user.name}}
                </v-card-text>
                <v-card-text>
                    phone:{{user.phone}}
                </v-card-text>
            </v-card>
        </v-card>
        <v-card style="margin-bottom:15px;">
            <v-card-title primary-title>
                Order Address
            </v-card-title>
            <v-card>
                <v-card-text>
                    ID:{{address.id}}
                </v-card-text>
                <v-card-text>
                    City:{{address.name}}
                </v-card-text>
                <v-card-text>
                    Area:{{address.area}}
                </v-card-text>
                <v-card-text>
                    Address:{{address.address}}
                </v-card-text>
                <v-card-text>
                    Note:{{address.note}}
                </v-card-text>
                <v-btn color="success" @click="open_map">Open Map</v-btn>
            </v-card>
        </v-card>
        <v-card style="margin-bottom:15px;">
            <v-card-title primary-title>
                Order Items
            </v-card-title>
            <v-card>
                <v-card-title primary-title>
                    Items
                </v-card-title>
                 <v-card style="margin-bottom:5px;" v-for="order_item in order_items" :key="order_item.id">
                    <v-card-text>
                        Item Id:{{order_item.items.id}}
                    </v-card-text>
                    <v-card-text>
                        Name:{{order_item.items.title}}
                    </v-card-text>
                    <v-card-text>
                        qty:{{order_item.qty}}
                    </v-card-text>
                    <v-card-text>
                        Total:{{order_item.total}}JOD
                    </v-card-text>
                    <v-card-text>
                        Note:{{order_item.note}}
                    </v-card-text>
                    <v-img
                    max-height="100"
                    max-width="100"
                    :src="'/storage/' +order_item.items.image"
                    ></v-img>
                    <v-divider></v-divider>
                </v-card>
            </v-card>
        </v-card>
        <v-card v-if="order.status == 0">
            <v-btn color="success" @click="setOrder(1)">Set InProcess</v-btn>
            <v-btn color="warning" @click="setOrder(3)">Cancel Order</v-btn>
        </v-card>
        <v-card v-if="order.status == 1">
            <v-btn color="success" @click="setOrder(2)">Complete Order</v-btn>
            <v-btn color="warning" @click="setOrder(3)">Cancel Order</v-btn>
        </v-card>
    </v-container>
</template>
<script>
export default {
    data(){
        return {
            order:{},
            user:{},
            address:{},
            order_items:[]
        }
    },
    created() {

        let vm = this;
        let id = vm.$route.params.id
        axios.get('/admin/order/show/' + id).then(res => {
            vm.order = res.data.order;
            vm.user = res.data.user;
            vm.address = res.data.address;
            vm.order_items = res.data.order_items;
        }).catch(err => {
            console.log(err)
        });

    },
    methods:{
        open_map() {
            let vm = this;
            window.open(`https://www.google.com/maps/search/?api=1&query=${vm.address.latitude},${vm.address.longitude}`);
        },
        setOrder(status) {
            let vm = this;

            axios.post('/admin/order/update_status',{
                order_id:vm.order.id,
                status:status
            }).then(res => {
                alert('Update Success');
                window.location.reload();
            }).catch(err => {
                console.log(err)
            });
        }
    }
}
</script>