<template>
    <Form
        #default="{ processing, errors }"
        @success="handleSuccess"
        :action="props.skill ? update(props.skill.id) : store()"
        resetOnSuccess
        class="flex-[1 1 300px] border(--border-card) flex max-w-[360px] min-w-0 flex-col gap-[20px] rounded-[8px] border bg-(--surface-container-low) p-[24px]"
    >
        <div class="flex flex-col gap-[4px]">
            <span class="text(--label-sm) text-xs">{{
                props.skill ? 'Edit Skill' : 'New Skill'
            }}</span>

            <h2 class="text(--headline-md) m-0 text-xl leading-[26px]">
                {{ props.skill ? props.skill.name : 'Add New Skill' }}
            </h2>
        </div>
        <Label for="skillName">Skill Name</Label>
        <Input
            v-model="newSkill.name"
            name="name"
            label="Skill Name"
            placeholder="Enter skill name"
        />
        <InputError :message="errors.name" />
        <Label for="category">Category</Label>
        <Select name="skill_category_id" v-model="newSkill.categoryId">
            <SelectTrigger>
                <SelectValue placeholder="Select a category" />
            </SelectTrigger>
            <SelectContent>
                <SelectGroup>
                    <SelectLabel>Categories</SelectLabel>
                    <SelectItem
                        v-for="(category, index) in props.categories"
                        :key="index"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </SelectItem>
                </SelectGroup>
            </SelectContent>
        </Select>
        <InputError :message="errors.skill_category_id" />
        <div class="flex flex-col gap-[10px]">
            <Label for="level">Level</Label>

            <Select name="level" v-model="newSkill.level">
                <SelectTrigger>
                    <SelectValue placeholder="Select Level" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectLabel>Level</SelectLabel>
                        <SelectItem value="1">Beginner</SelectItem>
                        <SelectItem value="2">Intermediate</SelectItem>
                        <SelectItem value="3">Advanced</SelectItem>
                        <SelectItem value="4">Expert</SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
            <InputError :message="errors.level" />
        </div>
        <div class="flex w-full min-w-0 flex-row gap-[8px]">
            <Button
                size="sm"
                type="button"
                @click="handleCancel"
                class="min-w-0 flex-1"
                variant="destructive"
                >Cancel</Button
            >
            <Button
                size="sm"
                type="submit"
                :disabled="processing"
                class="min-w-0 flex-1"
                >{{ submitLabel(processing) }}</Button
            >
        </div>
    </Form>
</template>

<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { ref } from 'vue';
import { store, update } from '@/actions/App/Http/Controllers/SkillController';
import InputError from '@/components/InputError.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select/';
import Button from './ui/button/Button.vue';
interface Props {
    categories: {
        id: number;
        name: string;
    }[];
    skill?: {
        id: number;
        name: string;
        level: number;
        categoryId: number;
    };
}
const props = defineProps<Props>();
const newSkill = ref<{
    name: string;
    categoryId: number | null;
    level: string | null;
}>({
    name: props.skill?.name ?? '',
    categoryId: props.skill?.categoryId ?? null,
    level: props.skill ? String(props.skill.level) : null,
});
const emit = defineEmits(['saved', 'cancel']);

const submitLabel = (processing: boolean) => {
    if (props.skill) {
        return processing ? 'Saving...' : 'Save Changes';
    }

    return processing ? 'Adding...' : 'Add Skill';
};

const handleSuccess = () => {
    emit('saved');
};

const handleCancel = () => {
    emit('cancel');
};
</script>

<style scoped></style>
