<template>
    <PageContent>
        <template #content>
            <ShowPageContent>
                <template #title> user Information </template>
                <ShowDescriptionList>
                    <ShowDescriptionItem>
                        <ShowTerm> user</ShowTerm>
                        <ShowData> {{ user.name }}</ShowData>
                    </ShowDescriptionItem>
                    <ShowDescriptionItem>
                        <ShowTerm>Email</ShowTerm>
                        <ShowData> {{ user.email }}</ShowData>
                    </ShowDescriptionItem>
                    <ShowDescriptionItem>
                        <ShowTerm>Roles</ShowTerm>
                        <ShowData> {{ user.roles.map((role) => role.name).join(", ") }}</ShowData>
                    </ShowDescriptionItem>
                </ShowDescriptionList>
            </ShowPageContent>
        </template>
    </PageContent>
</template>

<script setup>
import PageContent from "@/components/PageContent.vue";
import ShowPageContent from "./ShowPageContent.vue";
import ShowDescriptionList from "./ShowDescriptionList.vue";
import ShowDescriptionItem from "./ShowDescriptionItem.vue";
import ShowData from "./ShowData.vue";
import ShowTerm from "./ShowTerm.vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});
</script>
