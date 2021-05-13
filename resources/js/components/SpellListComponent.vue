<template>
    <div class="table-container is-fullwidth">
        <table class="table is-fullwidth is-hoverable">
            <thead>
            <tr class="title is-6">
                <table-element element-type="th">Title</table-element>
                <table-element element-type="th">User</table-element>
                <table-element element-type="th" v-if="showCategory">Category</table-element>
                <table-element element-type="th" text-class="has-text-centered">Replies</table-element>
                <table-element element-type="th">Created</table-element>
                <table-element element-type="th">Modified</table-element>
                <table-element element-type="th"></table-element>
            </tr>
            </thead>
            <tbody>
            <tr v-for="spell in spells" :key="spell.id">
                <table-element element-type="td">
                    <a :href="'/spell/' + spell.slug"
                       :title="spell.title">
                        <i class="fa fa-comment"></i>&nbsp;{{ spell.title }}
                    </a>
                </table-element>
                <table-element element-type="td">{{ spell.user.name }}</table-element>
                <table-element element-type="td" v-if="showCategory">{{ spell.kind.name }}</table-element>
<!--                <table-element element-type="td" text-class="has-text-centered">{{ spell.messages.length }}-->
<!--                </table-element>-->
                <table-element element-type="td">{{ spell.created_at | moment('DD.MM.YYYY') }}</table-element>
                <table-element element-type="td">{{ spell.updated_at | moment('DD.MM.YYYY') }}</table-element>
<!--                <table-element element-type="td">-->
<!--                    <p class="buttons" v-if="user.id === spell.user.id">-->
<!--                        <a :href="'/spell/' + spell.slug + '/edit'" class="button is-info is-outlined is-small">-->
<!--                            <span class="icon">-->
<!--                              <i class="fa fa-edit"></i>-->
<!--                            </span>-->
<!--                        </a>-->
<!--                        <button v-if="!spell.messages.length" @click="openDeleteModal(spell)"-->
<!--                                class="button is-danger is-outlined is-small">-->
<!--                            <span class="icon">-->
<!--                              <i class="fa fa-remove"></i>-->
<!--                            </span>-->
<!--                        </button>-->
<!--                    </p>-->
<!--                </table-element>-->
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "SpellListComponent",
        props: {
            spellList: {
                required: true
            },
            user: {
                required: true
            },
            showCategory: {
                required: false,
                default: true
            }
        },
        components: {
            TableElement
        },
        data() {
            return {
                spells: []
            }
        },
        methods: {
            openDeleteModal(spell) {
                this.$emit('open-modal',
                    {
                        id: spell.id,
                        title: spell.title,
                        content: 'Do you really want to delete this spell?',
                        url: '/spell/' + spell.slug
                    });
            }
        },
        created() {
            this.spells = this.spellList;
        },
        watch: {
            spellList(newVal) {
                this.spells = newVal;
            }
        }
    }
</script>

<style scoped>

</style>
