<template>
<div>

    <section v-if="!newDiscussion">
        <info></info>
        <discussion></discussion>
        <discussion :bg-color="'#DD5F5F'" :text-color="'#F1BFBF'"></discussion>
        <discussion :bg-color="'#8ABDB0'" :text-color="'#D0E4DF'"></discussion>
    </section>

    <new-discussion @cancel-discussion="cancelDiscussion" v-else></new-discussion>

    <div class="add-discussion-wrapper" v-if="!newDiscussion">
        <button class="add-discussion" @click="addNewDiscussion">
            <i class="fa fa-plus"></i>
        </button>
    </div>
</div>

</template>

<script>
import info from './info';
import discussion from './discussion';
import NewDiscussion from './NewDiscussion';
export default {
    components: {
        info,
        discussion,
        NewDiscussion
    },
    data() {
        return {
            newDiscussion: false
        }
    },
    methods: {
        addNewDiscussion() {
            this.newDiscussion = true
        },
        cancelDiscussion() {
            this.newDiscussion = false
        }
    },
}
</script>
