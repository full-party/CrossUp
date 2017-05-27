<template>
  <div @click="$emit('click')">?</div>
</template>

<style scoped>
  div {
    position: fixed;
    right: 16px;
    bottom: 16px;
    display: block;
    width: 56px;
    height: 56px;
    background: #03a9f4;
    text-align: center;
    border-radius: 50%;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.12), 0 2px 2px 0 rgba(0,0,0,.24);
    color: white;
    font-size: 24px;
  }
</style>