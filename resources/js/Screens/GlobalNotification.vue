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
            }
        }
    },
    methods:{
        send() {
            let vm = this;

            axios.post('/admin/send_notification',vm.notification).then(res => {
                console.log(res);
                alert('Send Success');
            }).catch(err => {
                console.log(err)
            });
        }
    }
}
</script>