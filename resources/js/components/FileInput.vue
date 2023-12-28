<template>
    <div class="flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
        <div class="space-y-1 text-center">
            <div class="flex text-sm text-gray-600">
                <label
                    class="relative cursor-pointer rounded-md bg-white font-medium text-yellow-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-yellow-500 focus-within:ring-offset-2 hover:text-yellow-600">
                    <span>Upload {{ allowMultiple ? "files" : "a file" }}</span>
                    <input
                        @input="emitInputEvent"
                        class="sr-only"
                        type="file"
                        :multiple="allowMultiple"
                        :accept="accept" />
                </label>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    allowMultiple: { required: false, type: Boolean },
    accept: { required: false, type: String },
});

const emit = defineEmits(["update:modelValue"]);

const emitInputEvent = (e) => {
    const files = e.target.files;
    emit("update:modelValue", files);
    e.target.value = null;
};
</script>
