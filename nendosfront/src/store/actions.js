export const retrieveData = (store, payload) => {
  store.dispatch('retrieveCounts', payload)
  store.dispatch('retrieveBoxes', payload)
  store.dispatch('retrieveNendoroids', payload)
}
