<template>
    <PageContent>
        <template #content>
            <ShowPageContent>
                <template #title> Book Information </template>
                <ShowDescriptionList>
                    <ShowDescriptionItem>
                        <ShowTerm> Name</ShowTerm>
                        <ShowData> {{ book.name }}</ShowData>
                    </ShowDescriptionItem>
                    <ShowDescriptionItem>
                        <ShowTerm>Publisher</ShowTerm>
                        <ShowData> {{ book.publisher }}</ShowData>
                    </ShowDescriptionItem>
                    <ShowDescriptionItem>
                        <ShowTerm>Pages</ShowTerm>
                        <ShowData> {{ book.pages }}</ShowData>
                    </ShowDescriptionItem>
                    <ShowDescriptionItem>
                        <ShowTerm>Isbn</ShowTerm>
                        <ShowData> {{ book.isbn }}</ShowData>
                    </ShowDescriptionItem>
                    <ShowDescriptionItem>
                        <ShowTerm>Category</ShowTerm>
                        <ShowData> {{ book.category?.name }}</ShowData>
                    </ShowDescriptionItem>
                    <ShowDescriptionItem>
                        <ShowTerm>Category</ShowTerm>
                        <ShowData> {{ book.sub_category }}</ShowData>
                    </ShowDescriptionItem>
                    <ShowDescriptionItem>
                        <ShowTerm>Description</ShowTerm>
                        <ShowData> {{ book.description }}</ShowData>
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
    book: {
        type: Object,
        required: true,
    },
});
</script>
