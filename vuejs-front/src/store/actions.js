export const retrieveData = (store, payload) => {
  store.dispatch('retrieveBoxes', payload)
  store.dispatch('retrieveNendoroids', payload)
  store.dispatch('retrieveFaces', payload)
  store.dispatch('retrieveHairs', payload)
  store.dispatch('retrieveHands', payload)
  store.dispatch('retrieveBodyparts', payload)
  store.dispatch('retrieveAccessories', payload)
  store.dispatch('retrievePhotos', payload)
  store.dispatch('retrievePhotoAccessories', payload)
  store.dispatch('retrievePhotoBodyparts', payload)
  store.dispatch('retrievePhotoBoxes', payload)
  store.dispatch('retrievePhotoFaces', payload)
  store.dispatch('retrievePhotoHairs', payload)
  store.dispatch('retrievePhotoHands', payload)
  store.dispatch('retrievePhotoNendoroids', payload)
  store.dispatch('retrieveUsers', payload)
  store.dispatch('retrieveNews', payload)
  if (store.state.auth.authenticated) {
    store.dispatch('retrieveAccessoriesTagsCodeList', payload)
  }
}
