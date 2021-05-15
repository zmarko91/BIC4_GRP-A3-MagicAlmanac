<template>
    <div class="container">
        <spell-detail :spell="spell"></spell-detail>
        <!--
        <spell-message-form :spell-id="spell.id" @new-message="sendNewMessage"></spell-message-form>
        -->
        <div v-if="showSuccessMessage" class="columns is-multiline">
            <div class="column is-half is-offset-one-quarter">
                <success-box :message="successMessage" v-if="showSuccessMessage"></success-box>
            </div>
        </div>
        <!--
        <spell-message-list v-if="hasMessages" :spell-messages="messages" :spell-slug="spell.slug" :new-message="newMessage"
                           @sync-messages="syncMessages" :current-user="currentUser"
                           @open-modal="setModal"></spell-message-list>

        <div v-if="!hasMessages" class="columns is-multiline">
            <div class="column is-half is-offset-one-quarter">
                <error-box message="No messages found" v-if="!hasMessages"></error-box>
            </div>
        </div>
        -->
        <delete-modal :title="modalTitle" :delete-url="modalUrl" :active="modalActive" :content="modalContent"
                      :entry-id="modalId" v-on:close-modal="toggleModal"></delete-modal>
    </div>
</template>

<script>

    export default {
        name: "SpellComponent",
        components: {
            ErrorBox,
            SuccessBox,
            DeleteModal,
        },
        props: {
            currentSpell: {
                required: true
            },
            currentMessages: {
                required: true
            },
            currentUser: {
                required: true
            },
        },
        data() {
            return {
                spell: [],
                messages: [],
                newMessage: {},
                modalActive: false,
                modalTitle: '',
                modalContent: '',
                modalUrl: '',
                modalId: 0,
                successMessage: ''
            }
        },
        methods: {
            sendNewMessage(message) {
                this.newMessage = message;

                if (!this.messages.length)
                    this.messages.push(message);
            },
            syncMessages(allMessages) {
                if (this.messages !== allMessages)
                    this.messages = allMessages.reverse();
            },
            toggleModal(info) {
                this.modalActive = !this.modalActive;

                if (info.id !== 0) {
                    this.messages = _.remove(this.messages, msg => msg.id !== info.id);
                    this.successMessage = info.message;
                }
            },
            setModal(data) {
                this.modalTitle = data.title;
                this.modalContent = data.content;
                this.modalUrl = data.url;
                this.modalId = data.id;
                this.toggleModal({id: 0});
            }
        },
        created() {
            this.spell = this.currentSpell;
/*
            if (this.currentMessages instanceof Object)
                Object.keys(this.currentMessages).forEach(item =>
                    this.messages.push(this.currentMessages[item]));
            else
                this.messages = this.currentMessages;

 */
        },
        computed: {
            /*
            hasMessages() {
                return !!this.messages.length;
            },

             */
            showSuccessMessage() {
                return this.successMessage !== '';
            }
        }
    }
</script>

<style scoped>

</style>
