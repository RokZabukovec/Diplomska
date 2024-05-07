<script setup>
import { ref, onMounted } from 'vue';
import Chart from 'chart.js/auto';
import MainLayout from "../../Layouts/MainLayout.vue";

const today = new Date();
const days = Array.from({ length: today.getDate() }, (_, i) => i + 1);
const labels = days.map(day => `${day}/${today.getMonth() + 1}`);

const newUsersData = ref({
    labels: labels,
    datasets: [
        {
            label: 'New Users',
            data: generateData(today.getDate()),
            fill: false,
            borderColor: '#4F46E5',
            tension: 0.4
        }
    ]
});

const newCommandsData = ref({
    labels: labels,
    datasets: [
        {
            label: 'New Commands',
            data: generateData(today.getDate()),
            fill: false,
            borderColor: '#22C55E',
            tension: 0.4
        }
    ]
});

const newProjectsData = ref({
    labels: labels,
    datasets: [
        {
            label: 'New Projects',
            data: generateData(today.getDate()),
            fill: false,
            borderColor: '#F97316',
            tension: 0.4
        }
    ]
});

const renderChart = (ref, data) => {
    const ctx = ref.value.getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: data.value,
        options: {
            scales: {
                x: {
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 10
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
};

const newUsersChart = ref(null);
const newCommandsChart = ref(null);
const newProjectsChart = ref(null);

onMounted(() => {
    renderChart(newUsersChart, newUsersData);
    renderChart(newCommandsChart, newCommandsData);
    renderChart(newProjectsChart, newProjectsData);
});

function generateData(days) {
    // Generate random data for demonstration
    return Array.from({ length: days }, () => Math.floor(Math.random() * 30));
}

</script>

<template>

    <MainLayout title="Statistics">
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="p-8">
                    <h2 class="text-xl font-semibold mb-4">Statistics</h2>

                    <!-- New Users Graph -->
                    <div class="bg-white p-4 rounded shadow mb-4">
                        <h3 class="mb-2">New Users</h3>
                        <canvas ref="newUsersChart" class="w-full"></canvas>
                    </div>

                    <!-- New Commands Graph -->
                    <div class="bg-white p-4 rounded shadow mb-4">
                        <h3 class="mb-2">New Commands</h3>
                        <canvas ref="newCommandsChart" class="w-full"></canvas>
                    </div>

                    <!-- New Projects Graph -->
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="mb-2">New Projects</h3>
                        <canvas ref="newProjectsChart" class="w-full"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>

</style>
