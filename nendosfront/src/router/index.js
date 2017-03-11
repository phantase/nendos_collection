import Vue from 'vue'
import Router from 'vue-router'
import Home from 'components/Home'
import Login from 'components/Login'
import Logout from 'components/Logout'
import Accessory from 'components/Accessory'
import Accessories from 'components/Accessories'
import Bodypart from 'components/Bodypart'
import Bodyparts from 'components/Bodyparts'
import Box from 'components/Box'
import BoxCollect from 'components/BoxCollect'
import Boxes from 'components/Boxes'
import Face from 'components/Face'
import Faces from 'components/Faces'
import Hair from 'components/Hair'
import Hairs from 'components/Hairs'
import Hand from 'components/Hand'
import Hands from 'components/Hands'
import Nendoroid from 'components/Nendoroid'
import Nendoroids from 'components/Nendoroids'
import Photo from 'components/Photo'
import Photos from 'components/Photos'
import AddAccessory from 'components/forms/AddAccessory'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      meta: {
        description: 'Homepage of the database'
      },
      component: Home
    },
    {
      path: '/login',
      name: 'Login',
      meta: {
        description: 'Login'
      },
      component: Login
    },
    {
      path: '/logout',
      name: 'Logout',
      meta: {
        description: 'Logout'
      },
      component: Logout
    },
    {
      path: '/accessory/add',
      name: 'Add accessory',
      meta: {
        description: 'Add a new accessory',
        breadcrumb: [
          {
            title: 'Accessories',
            link: '/accessories'
          }
        ]
      },
      component: AddAccessory
    },
    {
      path: '/accessory/:id',
      name: 'Accessory',
      meta: {
        description: 'A single accessory',
        breadcrumb: [
          {
            title: 'Accessories',
            link: '/accessories'
          }
        ]
      },
      component: Accessory
    },
    {
      path: '/accessories',
      name: 'Accessories',
      meta: {
        description: 'List of all accessories'
      },
      component: Accessories
    },
    {
      path: '/bodypart/:id',
      name: 'Bodypart',
      meta: {
        description: 'A single bodypart',
        breadcrumb: [
          {
            title: 'Bodyparts',
            link: '/bodyparts'
          }
        ]
      },
      component: Bodypart
    },
    {
      path: '/bodyparts',
      name: 'Bodyparts',
      meta: {
        description: 'List of all bodyparts'
      },
      component: Bodyparts
    },
    {
      path: '/box/:id',
      name: 'Box',
      meta: {
        description: 'A single box',
        breadcrumb: [
          {
            title: 'Boxes',
            link: '/boxes'
          }
        ]
      },
      component: Box
    },
    {
      path: '/box/:id/collect',
      name: 'Box Collection',
      meta: {
        description: 'Collection of a box',
        breadcrumb: [
          {
            title: 'Boxes',
            link: '/boxes'
          },
          {
            title: 'Box',
            link: '/box/:id'
          }
        ]
      },
      component: BoxCollect
    },
    {
      path: '/boxes',
      name: 'Boxes',
      meta: {
        description: 'List of all boxes'
      },
      component: Boxes
    },
    {
      path: '/face/:id',
      name: 'Face',
      meta: {
        description: 'A single face',
        breadcrumb: [
          {
            title: 'Faces',
            link: '/faces'
          }
        ]
      },
      component: Face
    },
    {
      path: '/faces',
      name: 'Faces',
      meta: {
        description: 'List of all faces'
      },
      component: Faces
    },
    {
      path: '/hair/:id',
      name: 'Hair',
      meta: {
        description: 'A single hair',
        breadcrumb: [
          {
            title: 'Hairs',
            link: '/hairs'
          }
        ]
      },
      component: Hair
    },
    {
      path: '/hairs',
      name: 'Hairs',
      meta: {
        description: 'List of all hairs'
      },
      component: Hairs
    },
    {
      path: '/hand/:id',
      name: 'Hand',
      meta: {
        description: 'A single hand',
        breadcrumb: [
          {
            title: 'Hands',
            link: '/hands'
          }
        ]
      },
      component: Hand
    },
    {
      path: '/hands',
      name: 'Hands',
      meta: {
        description: 'List of all hands'
      },
      component: Hands
    },
    {
      path: '/nendoroid/:id',
      name: 'Nendoroid',
      meta: {
        description: 'A single nendoroid',
        breadcrumb: [
          {
            title: 'Nendoroids',
            link: '/nendoroids'
          }
        ]
      },
      component: Nendoroid
    },
    {
      path: '/nendoroids',
      name: 'Nendoroids',
      meta: {
        description: 'List of all nendoroids'
      },
      component: Nendoroids
    },
    {
      path: '/photo/:id',
      name: 'Photo',
      meta: {
        description: 'A single photo',
        breadcrumb: [
          {
            title: 'Photos',
            link: '/photos'
          }
        ]
      },
      component: Photo
    },
    {
      path: '/photos',
      name: 'Photos',
      meta: {
        description: 'List of all photos'
      },
      component: Photos
    }
  ]
})
