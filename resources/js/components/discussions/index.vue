<template>
<div>
    <info></info>
    <discussion></discussion>
    <new-discussion></new-discussion>
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
    }
}
</script>
