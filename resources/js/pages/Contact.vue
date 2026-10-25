<template>
    <Head title="Contact Deverick Strand" />
    <h1>Reach Out</h1>
    <div class="m-4 flex justify-center">
        <Form
            class="rounded-lg border border-(--border) bg-(--surface-container-lowest) p-6"
            method="post"
            action="/contact"
        >
            <section class="flex flex-col gap-2">
                <label for="name">Name</label>
                <Input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Your Name"
                    required
                />
            </section>
            <section class="mt-4 flex flex-row gap-2">
                <section class="flex flex-col gap-2">
                    <label for="email">Email</label>
                    <Input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Your Email"
                        required
                    />
                </section>
                <section class="flex flex-col gap-2">
                    <label for="phone">Phone</label>
                    <Input
                        id="phone"
                        name="phone"
                        type="tel"
                        placeholder="Your Phone Number"
                    />
                </section>
            </section>
            <section class="mt-4 flex flex-col gap-2">
                <label for="subject">Subject</label>
                <Input
                    id="subject"
                    name="subject"
                    type="text"
                    placeholder="Subject"
                    required
                />
            </section>
            <section class="mt-4 flex flex-col gap-2">
                <label for="message">Message</label>
                <Textarea
                    id="message"
                    name="message"
                    placeholder="Your Message"
                    required
                />
            </section>
            <Button class="mt-4" type="submit">Send</Button>
        </Form>
    </div>
</template>

<script setup lang="ts">
import Input from '@/components/ui/input/Input.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';
import { Form, Head } from '@inertiajs/vue3';
</script>
<style scoped></style>
