<template>
    <div class="container">
<!--        <spell-form :spell="spell"></spell-form>-->

        <spell-message-form :spell-id="spell.id" @new-message="sendNewMessage"></spell-message-form>

      <div v-if="showSuccessMessage" class="columns is-multiline">
            <div class="column is-half is-offset-one-quarter">
                <success-box :message="successMessage" v-if="showSuccessMessage"></success-box>
            </div>
        </div>

        <spell-message-list v-if="hasMessages" :spell-messages="messages" :spell-slug="spell.slug" :new-message="newMessage"
                           @sync-messages="syncMessages" :current-user="currentUser"
                           @open-modal="setModal"></spell-message-list>

        <div v-if="!hasMessages" class="columns is-multiline">
            <div class="column is-half is-offset-one-quarter">
                <error-box message="No messages found" v-if="!hasMessages"></error-box>
            </div>
        </div>

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
