<template>
	<div>
		<h2>Chat</h2>
		<input type="text"
		 v-model="message"
		@keyup.enter="store"
		 placeholder="Type message..."
		>
		<button
		  @click="store"
		  :disabled="message.length < 1"
		>
		Send Message
		</button>
		<h3>Messages</h3>
		<ul>
		<li v-for="conversation in conversations" :key="conversation.id">{{ conversation.message }} from {{ conversation.user }}</li>
		</ul>
	</div>
</template>
<script>
    export default {
        data() {
            return {
                conversations: [],
                message: '',
            }
        },
        mounted() {
            this.getConversations();
            this.listen();
        },
        methods: {
            store() {
                axios.post('/mix/public/api/conversations/store', {
                    message: this.message
                })
                .then((response) => {
                    this.message = '';
                    this.conversations.push(response.data);
                });
            },
            getConversations() {
                axios.get('/mix/public/api/conversations', {})
                .then((response) => {
                    this.conversations = response.data;
					//this.conversations.reverse();
                });
            },
            listen() {
                Echo.channel('public-chat')
                    .listen('NewMessage', (e) => {
                        this.conversations.push(e.conversation);
                    });
            }
        }
    }
</script>