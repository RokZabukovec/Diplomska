<script setup>

</script>

<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50" height="50">
        <!-- Black rounded square background -->
        <rect x="0" y="0" width="50" height="50" rx="5" ry="5" fill="black"></rect>
        <!-- White letter C with Helvetica font -->
        <text x="8" y="35" font-family="Helvetica, Arial, sans-serif" font-size="30" fill="white">C</text>
        <!-- Blinking Pipe with Courier New font -->
        <text x="26" y="32" font-family="Courier New, monospace" font-size="33" fill="white" font-weight="bold">
            <animate attributeName="opacity" dur="1s" repeatCount="indefinite" values="0;1;0"></animate>
            |
        </text>
    </svg>
</template>
