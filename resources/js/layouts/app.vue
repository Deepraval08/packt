<template>
  <MyHeader title="Packt" />
   <router-view />
 </template>
 
 <script>
   import MyHeader from '../components/MyHeader.vue'

   export default {
     name: 'App',
     components: {
       MyHeader,
     }
 
   }
 </script>
 
 <style>
  
 </style>