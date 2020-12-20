<template>
    <v-container>
        <v-card>
            <v-card-title>
                Send Notification
            </v-card-title>
            <v-text-field
                placeholder="العنوان"
                label="العنوان"
                v-model="notification.title"
            ></v-text-field>
            <v-textarea 
                placeholder="الوصف"
                label="الوصف"
                v-model="notification.body"
            />
            <v-btn color="success" @click="send">
                Send
            </v-btn>
        </v-card>
    </v-container>
</template>
<script>
export default {
    data() {
        return {
            notification:{
                title:'',
                body:''
            },
            tokens:[]
        }
    },
    methods:{
        send() {
            let vm = this;

            axios.post('http://35.238.84.41:3000/send_notification',{
                tokens:vm.tokens,
                title:vm.notification.title,
                body:vm.notification.body
            }).then(res => {
                alert('Success Send Message')
            }).catch(err => {
                console.log(err)
            });
        },
        get(){
            let vm = this;
            axios.get('/admin/notification_token/get').then(res => {

                vm.tokens = res.data;
}).catch(err => {
                console.log(err)
            });
        }
    },
    mounted() {
        let vm = this;
        vm.get();
    }
}
</script>