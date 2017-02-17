import Vue from 'vue'
import Router from 'vue-router'
import Hello from 'components/Home'
import Accessory from 'components/Accessory'
import Accessories from 'components/Accessories'
import Bodypart from 'components/Bodypart'
import Bodyparts from 'components/Bodyparts'
import Box from 'components/Box'
import Boxes from 'components/Boxes'
import Face from 'components/Face'
import Faces from 'components/Faces'
import Hair from 'components/Hair'
import Hairs from 'components/Hairs'
import Hand from 'components/Hand'
import Hands from 'components/Hands'
import Nendoroid from 'components/Nendoroid'
import Nendoroids from 'components/Nendoroids'
import Photos from 'components/Photos'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      meta: {
        description: 'Homepage of the database'
      },
      component: Hello
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
      path: '/photos',
      name: 'Photos',
      meta: {
        description: 'List of all photos'
      },
      component: Photos
    }
  ]
})
