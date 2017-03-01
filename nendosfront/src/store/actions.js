export const retrieveData = (store, payload) => {
  store.dispatch('retrieveCounts', payload)
  store.dispatch('retrieveBoxes', payload)
  store.dispatch('retrieveNendoroids', payload)
  store.dispatch('retrieveFaces', payload)
  store.dispatch('retrieveHairs', payload)
}
