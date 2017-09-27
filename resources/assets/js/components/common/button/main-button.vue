<template>
  <div @click="$emit('click')">
    <slot>
    </slot>
  </div>
</template>

<style scoped>
  div {
    border: 1px solid #000;
    padding: 12px 10px;
    font-size: 18px;
    text-align: center;
    border-radius: 3px;
    background: #fff;
    box-shadow: inset 0 -2px rgb(241, 241, 241);
  }
</style>