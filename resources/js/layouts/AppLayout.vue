<script setup lang="ts">
import { home, work, resume, contact, skills } from '@/routes';
</script>

<template>
    <div
        class="min-h-screen bg-background p-6 text-foreground lg:justify-center lg:p-8"
    >
        <header
            class="mb-6 w-full max-w-83.75 text-sm not-has-[nav]:hidden lg:max-w-4xl"
        >
            <div class="nav-7">
                <Link :href="home()">Deverick Strand</Link>
                <nav
                    class="pt-50px h-100px relative top-1/2 left-1/2 -ml-100 max-w-full transform-[translateY(-50%)]"
                >
                    <Link class="item" :href="home()">
                        <span class="linktext">Home</span>
                    </Link>
                    <Link class="item" :href="work()">
                        <span class="linktext">Work</span>
                    </Link>
                    <Link class="item" :href="resume()">
                        <span class="linktext">Resume</span>
                    </Link>
                    <Link class="item" :href="contact()">
                        <span class="linktext">Contact</span>
                    </Link>
                    <Link class="item" :href="skills()">
                        <span class="linktext">Skills</span>
                    </Link>
                </nav>
            </div>
        </header>
        <slot></slot>
    </div>
</template>
<style scoped>
@reference '../../css/app.css';

.nav-7 .linktext:before {
    display: inline-block;
    content: '';
    z-index: -1;
    position: absolute;
    left: 10px;
    height: 100%;
    width: calc(100% + 20px);
    transition: 0.3s ease-in-out;
    transition-delay: 0s;
    opacity: 1;
    @apply bg-primary;
    border-radius: 10px;
    transform: scale(0.2);
    opacity: 0;
}
.nav-7 .linktext {
    font-size: 1.3em;
    text-align: center;
    position: relative;
    z-index: 2;
    @apply text-primary;
    text-decoration: none;
    text-transform: uppercase;
    transition: 0.3s ease-in-out;
}
.nav-7 .item {
    position: relative;
    display: inline-block;
    height: 35px;
    padding-top: 15px;
    margin-left: 25px;
    margin-right: 25px;
    margin-bottom: 20px;
    background: transparent;
    transition: 0.3s ease-in-out;
    -webkit-transition: 0.3s ease-in-out;
    z-index: 2;
    text-decoration: none;
    font-family: Arial, sans-serif;
    text-transform: uppercase;
}
.nav-7 .item:hover .linktext {
    transform: scale(1.2);
    -webkit-transform: scale(1.2);
    @apply text-secondary;
}
.nav-7 .item:hover .linktext:before,
.nav-7 .item:hover .linktext:after {
    opacity: 1;
    transform: scale(1);
    -webkit-transform: scale(1);
}
.nav-7 .linktext:after {
    position: absolute;
    content: '';
    width: 0;
    height: 0;
    top: 25px;
    left: calc(50% - 20px);
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-top: 20px solid #bd1c31;
    transform: scale(0.2) translateY(-100px);
    opacity: 0;
    transition: 0.3s ease-in-out;
}
</style>
