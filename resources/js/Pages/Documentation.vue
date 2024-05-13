<script setup>

</script>

<template>
    <div class="max-w-3xl mx-auto bg-white p-8 mt-10 rounded shadow-md">

        <h1 class="text-3xl font-bold mb-6 text-center">Building a .NET Global Tool</h1>

        <div class="mb-6">
            <p class="text-lg font-semibold mb-2">Overview</p>
            <p class="mb-2">A .NET Global Tool is a .NET Core/.NET 5+ application that can be installed and run from any location on your system. It provides a convenient way to distribute and use command-line utilities written in .NET.</p>
        </div>

        <div class="mb-6">
            <p class="text-lg font-semibold mb-2">Dependencies</p>
            <ul class="list-disc list-inside">
                <li>dotnet SDK - Ensure you have the .NET SDK installed on your system. You can download it from <a href="https://dotnet.microsoft.com/download">dotnet.microsoft.com/download</a>.</li>
                <li>Spectre.Cli - A library for building command-line applications. Install it using the following command:
                    <code class="block bg-gray-200 p-2 rounded mt-2">dotnet add package Spectre.Cli</code>
                </li>
                <li>Other dependencies as required by your application.</li>
            </ul>
        </div>

        <div class="mb-6">
            <p class="text-lg font-semibold mb-2">Building the Global Tool</p>
            <ol class="list-decimal list-inside">
                <li>Create a new .NET Core/.NET 5+ console application using your preferred development environment or the following command:
                    <code class="block bg-gray-200 p-2 rounded mt-2">dotnet new console -n YourToolName</code>
                </li>
                <li>Implement your command-line functionality using Spectre.Cli or any other libraries.</li>
                <li>Build your application using the following command:
                    <code class="block bg-gray-200 p-2 rounded mt-2">dotnet build -c Release</code>
                </li>
                <li>Publish your application as a global tool using the following command:
                    <code class="block bg-gray-200 p-2 rounded mt-2">dotnet publish -c Release -r linux-x64 -p:PublishSingleFile=true -o out</code>
                </li>
                <li>Optionally, test your tool locally before publishing it globally using the following command:
                    <code class="block bg-gray-200 p-2 rounded mt-2">dotnet tool install -g --add-source ./out YourToolName</code>
                </li>
            </ol>
        </div>

        <div class="mb-6">
            <p class="text-lg font-semibold mb-2">Installing and Using the Global Tool</p>
            <p class="mb-2">To install and use your global tool:</p>
            <ol class="list-decimal list-inside">
                <li>Package your tool as a .nupkg file or publish it to a NuGet feed.</li>
                <li>Install your tool globally using the following command:
                    <code class="block bg-gray-200 p-2 rounded mt-2">dotnet tool install -g YourToolName --version x.x.x</code>
                </li>
                <li>Run your tool from any command prompt or terminal using its command name.</li>
            </ol>
        </div>

    </div>
</template>

<style scoped>

</style>
