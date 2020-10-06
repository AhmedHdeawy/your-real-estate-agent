<template>
<div>
    <info></info>
    <discussion></discussion>
    <discussion :bg-color="'#DD5F5F'"></discussion>
    <discussion :bg-color="'#9EC41C'"></discussion>
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
