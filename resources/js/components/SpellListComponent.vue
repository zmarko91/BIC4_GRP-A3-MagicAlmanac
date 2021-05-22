<template>
    <div class="table-container is-fullwidth">
        <table class="table is-fullwidth is-hoverable">
            <thead>
            <tr class="title is-6">
                <table-element element-type="th">Name</table-element>
                <table-element element-type="th">Quote</table-element>
                <table-element element-type="th" v-if="showKind">Kind</table-element>
                <table-element element-type="th">Created</table-element>
                <table-element element-type="th">Modified</table-element>
                <table-element element-type="th">Edit/Delete/View</table-element>
            </tr>
            </thead>


            <tbody>
            <tr v-for="spell in spells" :key="spell.id">
                <table-element element-type="td">{{spell.name}}</table-element>
                <table-element element-type="td">{{spell.quote}}</table-element>
                <table-element element-type="td" v-if="showKind">{{ spell.kind.name }}</table-element>
                <table-element element-type="td">{{ spell.created_at | formatDate}}</table-element>
                <table-element element-type="td">{{ spell.updated_at | formatDate}}</table-element>
                <table-element element-type="td">
                    <p class="buttons">
                        <a :href="'/spell/' + spell.slug + '/edit'" class="button is-info is-outlined is-small">
                            <span class="icon">
                              <i class="fa fa-edit"></i>
                            </span>
                        </a>
                        <button v-if="!spell.length" @click="openDeleteModal(spell)" class="button is-danger is-outlined is-small">
                            <span class="icon">
                                <i class="fas fa-trash"></i>
                            </span>
                        </button>
                        <a :href="'/spell/' + spell.slug" class="button is-info is-outlined is-small">
                            <span class="icon">
                              <i class="fas fa-eye"></i>
                            </span>
                        </a>
                    </p>
                </table-element>
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
            showKind: {
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
