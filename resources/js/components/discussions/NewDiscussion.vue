<template>
    <section class="new_discussion overflow-hidden">
        <div class="row new_discussion_header p-2">
            <div class="col">
                <button class="no-btn" @click="cancelCreation">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </div>
            <div class="col text-right">
                <button class="no-btn">
                    Next
                </button>
            </div>
        </div>
        <div class="row new_discussion_text">
            <textarea name="content" class="px-4" :placeholder="placeholder"></textarea>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            placeholder: 'Share your thoughts and experiences with the people around you.'
        }
    },
    methods: {
        cancelCreation() {
            this.$emit('cancel-discussion');
        }
    },
}
</script>

<style>

</style>
