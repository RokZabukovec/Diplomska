<template>
    <div class="flex flex-wrap">
        <v-chart class="chart rounded max-h-96" :option="userCountOption" autoresize />
        <v-chart class="chart rounded max-h-96" :option="projectCountOption" autoresize />
    </div>
</template>

<script setup>
import { use } from 'echarts/core';
import { SVGRenderer } from 'echarts/renderers';
import { PieChart } from 'echarts/charts';
import {
    TitleComponent,
    TooltipComponent,
    LegendComponent,
} from 'echarts/components';
import VChart, { THEME_KEY } from 'vue-echarts';
import { ref, provide } from 'vue';
import * as echarts from 'echarts';

use([
    SVGRenderer,
    PieChart,
    TitleComponent,
    TooltipComponent,
    LegendComponent,
]);

provide(THEME_KEY, 'light');

const userCountOption = {
    color: ['#80FFA5', '#00DDFF', '#37A2FF', '#FF0087', '#FFBF00'],
    title: {
        text: 'Number of users'
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            label: {
                backgroundColor: '#6a7985'
            }
        }
    },
    legend: {
        data: ['Users']
    },
    grid: {
        left: '3%',
        right: '4%',

        containLabel: true
    },
    xAxis: [
        {
            type: 'category',
            boundaryGap: false,
            data: ['January', 'February', 'March', 'April', 'June', 'July', 'August', 'September', 'November', 'December']
        }
    ],
    yAxis: [
        {
            type: 'value'
        }
    ],
    series: [
        {
            name: 'Users',
            type: 'line',
            stack: 'Total',
            smooth: true,
            lineStyle: {
                width: 0
            },
            showSymbol: false,
            areaStyle: {
                opacity: 0.8,
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                    {
                        offset: 0,
                        color: 'rgb(128, 255, 165)'
                    },
                    {
                        offset: 1,
                        color: 'rgb(1, 191, 236)'
                    }
                ])
            },
            emphasis: {
                focus: 'series'
            },
            data: [10, 15, 50, 55, 110, 150, 250, 180, 110, 165]
        },
    ]
};
const projectCountOption = {
    color: ['#FFBF00'],
    title: {
        text: 'Number of projects'
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            label: {
                backgroundColor: '#6a7985'
            }
        }
    },
    legend: {
        data: ['Projects']
    },
    grid: {
        containLabel: true
    },
    xAxis: [
        {
            type: 'category',
            boundaryGap: false,
            data: ['January', 'February', 'March', 'April', 'June', 'July', 'August', 'September', 'November', 'December']
        }
    ],
    yAxis: [
        {
            type: 'value'
        }
    ],
    series: [
        {
            name: 'Projects',
            type: 'line',
            stack: 'Total',
            smooth: true,
            lineStyle: {
                width: 0
            },
            showSymbol: false,
            areaStyle: {
                opacity: 0.8,
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                    {
                        offset: 0,
                        color: 'rgb(232,34,196)'
                    },
                    {
                        offset: 1,
                        color: 'rgb(42,172,213)'
                    }
                ])
            },
            emphasis: {
                focus: 'series'
            },
            data: [10, 55, 150, 505, 450, 210, 440, 656, 800, 782]
        },
    ]
};
</script>

<style scoped>
.chart {
    height: 100vh;
}
</style>
