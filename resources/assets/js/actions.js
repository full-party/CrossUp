export default {
  setGame (context, game) {
    localStorage.setItem('game', JSON.stringify(game));
    context.commit('SET_GAME', game);
  },
}