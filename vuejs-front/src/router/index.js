import Vue from 'vue'
import Router from 'vue-router'
import Home from 'components/Home'
import Login from 'components/Login'
import Logout from 'components/Logout'
import Register from 'components/Register'
import ForgotPass from 'components/ForgotPass'
import Confirm from 'components/Confirm'
import ConfirmForgot from 'components/ConfirmForgot'
import Accessory from 'components/Accessory'
import Accessories from 'components/Accessories'
import Bodypart from 'components/Bodypart'
import Bodyparts from 'components/Bodyparts'
import Box from 'components/Box'
import BoxCollect from 'components/BoxCollect'
import BoxUncollect from 'components/BoxUncollect'
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
import FormAccessory from 'components/forms/FormAccessory'
import FormBodypart from 'components/forms/FormBodypart'
import FormFace from 'components/forms/FormFace'
import FormHair from 'components/forms/FormHair'
import FormHand from 'components/forms/FormHand'
import FormNendoroid from 'components/forms/FormNendoroid'
import FormBox from 'components/forms/FormBox'
import FormImage from 'components/forms/FormImage'
import FormPhoto from 'components/forms/FormPhoto'
import FormPhotoPart from 'components/forms/FormPhotoPart'
import AddPart from 'components/forms/AddPart'
import Search from 'components/Search'
import News from 'components/News'
import SingleNews from 'components/SingleNews'
import FormSingleNews from 'components/forms/FormSingleNews'
import Users from 'components/Users'
import User from 'components/User'
import UserFavorites from 'components/UserFavorites'
import UserCollection from 'components/UserCollection'
import UserPhotos from 'components/UserPhotos'
import FormUser from 'components/forms/FormUser'
import About from 'components/About'

Vue.use(Router)

export default new Router({
  mode: 'history',
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
      path: '/register',
      name: 'Register',
      meta: {
        description: 'Register'
      },
      component: Register
    },
    {
      path: '/confirm',
      name: 'Confirm',
      meta: {
        description: 'Confirm'
      },
      component: Confirm
    },
    {
      path: '/forgotpass',
      name: 'Forgot password',
      meta: {
        description: 'Forgot password'
      },
      component: ForgotPass
    },
    {
      path: '/confirmforgot',
      name: 'Confirm forgot password',
      meta: {
        description: 'Confirm forgot password'
      },
      component: ConfirmForgot
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
      component: FormAccessory
    },
    {
      path: '/accessory/add/from/:frompart/:fromid',
      name: 'Add accessory from',
      meta: {
        description: 'Add a new accessory',
        breadcrumb: [
          {
            title: 'Accessories',
            link: '/accessories'
          }
        ]
      },
      component: FormAccessory
    },
    {
      path: '/accessory/:id/edit/image/:number',
      name: 'Edit accessory photo',
      meta: {
        description: 'Edit the photo of an accessory',
        breadcrumb: [
          {
            title: 'Accessories',
            link: '/accessories'
          },
          {
            title: 'Accessory',
            link: '/accessory/:id'
          }
        ]
      },
      component: FormImage
    },
    {
      path: '/accessory/:id/edit',
      name: 'Edit accessory',
      meta: {
        description: 'Edit an accessory',
        breadcrumb: [
          {
            title: 'Accessories',
            link: '/accessories'
          },
          {
            title: 'Accessory',
            link: '/accessory/:id'
          }
        ]
      },
      component: FormAccessory
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
      path: '/bodypart/add',
      name: 'Add bodypart',
      meta: {
        description: 'Add a new bodypart',
        breadcrumb: [
          {
            title: 'Bodyparts',
            link: '/bodyparts'
          }
        ]
      },
      component: FormBodypart
    },
    {
      path: '/bodypart/add/from/:frompart/:fromid',
      name: 'Add bodypart from',
      meta: {
        description: 'Add a new bodypart',
        breadcrumb: [
          {
            title: 'Bodyparts',
            link: '/bodyparts'
          }
        ]
      },
      component: FormBodypart
    },
    {
      path: '/bodypart/:id/edit/image/:number',
      name: 'Edit bodypart photo',
      meta: {
        description: 'Edit the photo of a bodypart',
        breadcrumb: [
          {
            title: 'Bodyparts',
            link: '/bodyparts'
          },
          {
            title: 'Bodypart',
            link: '/bodypart/:id'
          }
        ]
      },
      component: FormImage
    },
    {
      path: '/bodypart/:id/edit',
      name: 'Edit bodypart',
      meta: {
        description: 'Edit a bodypart',
        breadcrumb: [
          {
            title: 'Bodyparts',
            link: '/bodyparts'
          },
          {
            title: 'Bodypart',
            link: '/bodypart/:id'
          }
        ]
      },
      component: FormBodypart
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
      path: '/box/add',
      name: 'Add box',
      meta: {
        description: 'Add a new box',
        breadcrumb: [
          {
            title: 'Boxes',
            link: '/boxes'
          }
        ]
      },
      component: FormBox
    },
    {
      path: '/box/:id/edit/image/:number',
      name: 'Edit box photo',
      meta: {
        description: 'Edit the photo of a box',
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
      component: FormImage
    },
    {
      path: '/box/:id/edit',
      name: 'Edit box',
      meta: {
        description: 'Edit a box',
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
      component: FormBox
    },
    {
      path: '/box/:id/addpart',
      name: 'Add part to box',
      meta: {
        description: 'Add a part to a box',
        breadcrumb: [
          {
            title: 'Boxes',
            link: '/boxes'
          },
          {
            title: 'Box',
            link: '/box/:id'
          }
        ],
        frompart: 'box'
      },
      component: AddPart
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
      path: '/box/:id/uncollect',
      name: 'Box Uncollection',
      meta: {
        description: 'Uncollection of a box',
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
      component: BoxUncollect
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
      path: '/face/add',
      name: 'Add face',
      meta: {
        description: 'Add a new face',
        breadcrumb: [
          {
            title: 'Faces',
            link: '/faces'
          }
        ]
      },
      component: FormFace
    },
    {
      path: '/face/add/from/:frompart/:fromid',
      name: 'Add face from',
      meta: {
        description: 'Add a new face',
        breadcrumb: [
          {
            title: 'Faces',
            link: '/faces'
          }
        ]
      },
      component: FormFace
    },
    {
      path: '/face/:id/edit/image',
      name: 'Edit face photo',
      meta: {
        description: 'Edit the photo of a face',
        breadcrumb: [
          {
            title: 'Faces',
            link: '/faces'
          },
          {
            title: 'Face',
            link: '/face/:id'
          }
        ]
      },
      component: FormImage
    },
    {
      path: '/face/:id/edit',
      name: 'Edit face',
      meta: {
        description: 'Edit a face',
        breadcrumb: [
          {
            title: 'Faces',
            link: '/faces'
          },
          {
            title: 'Face',
            link: '/face/:id'
          }
        ]
      },
      component: FormFace
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
      path: '/hair/add',
      name: 'Add hair',
      meta: {
        description: 'Add a new hair',
        breadcrumb: [
          {
            title: 'Hairs',
            link: '/hairs'
          }
        ]
      },
      component: FormHair
    },
    {
      path: '/hair/add/from/:frompart/:fromid',
      name: 'Add hair from',
      meta: {
        description: 'Add a new hair',
        breadcrumb: [
          {
            title: 'Hairs',
            link: '/hairs'
          }
        ]
      },
      component: FormHair
    },
    {
      path: '/hair/:id/edit/image',
      name: 'Edit hair photo',
      meta: {
        description: 'Edit the photo of a hair',
        breadcrumb: [
          {
            title: 'Hairs',
            link: '/hairs'
          },
          {
            title: 'Hair',
            link: '/hair/:id'
          }
        ]
      },
      component: FormImage
    },
    {
      path: '/hair/:id/edit',
      name: 'Edit hair',
      meta: {
        description: 'Edit a hair',
        breadcrumb: [
          {
            title: 'Hairs',
            link: '/hairs'
          },
          {
            title: 'Hair',
            link: '/hair/:id'
          }
        ]
      },
      component: FormHair
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
      path: '/hand/add',
      name: 'Add hand',
      meta: {
        description: 'Add a new hand',
        breadcrumb: [
          {
            title: 'Hands',
            link: '/hands'
          }
        ]
      },
      component: FormHand
    },
    {
      path: '/hand/add/from/:frompart/:fromid',
      name: 'Add hand from',
      meta: {
        description: 'Add a new hand',
        breadcrumb: [
          {
            title: 'Hands',
            link: '/hands'
          }
        ]
      },
      component: FormHand
    },
    {
      path: '/hand/:id/edit/image',
      name: 'Edit hand photo',
      meta: {
        description: 'Edit the photo of a hand',
        breadcrumb: [
          {
            title: 'Hands',
            link: '/hands'
          },
          {
            title: 'Hand',
            link: '/hand/:id'
          }
        ]
      },
      component: FormImage
    },
    {
      path: '/hand/:id/edit',
      name: 'Edit hand',
      meta: {
        description: 'Edit a hand',
        breadcrumb: [
          {
            title: 'Hands',
            link: '/hands'
          },
          {
            title: 'Hand',
            link: '/hand/:id'
          }
        ]
      },
      component: FormHand
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
      path: '/nendoroid/add',
      name: 'Add nendoroid',
      meta: {
        description: 'Add a new nendoroid',
        breadcrumb: [
          {
            title: 'Nendoroids',
            link: '/nendoroids'
          }
        ]
      },
      component: FormNendoroid
    },
    {
      path: '/nendoroid/add/from/:frompart/:fromid',
      name: 'Add nendoroid from',
      meta: {
        description: 'Add a new nendoroid',
        breadcrumb: [
          {
            title: 'Nendoroids',
            link: '/nendoroids'
          }
        ]
      },
      component: FormNendoroid
    },
    {
      path: '/nendoroid/:id/edit/image',
      name: 'Edit nendoroid photo',
      meta: {
        description: 'Edit the photo of a nendoroid',
        breadcrumb: [
          {
            title: 'Nendoroids',
            link: '/nendoroids'
          },
          {
            title: 'Nendoroid',
            link: '/nendoroid/:id'
          }
        ]
      },
      component: FormImage
    },
    {
      path: '/nendoroid/:id/edit',
      name: 'Edit nendoroid',
      meta: {
        description: 'Edit a nendoroid',
        breadcrumb: [
          {
            title: 'Nendoroids',
            link: '/nendoroids'
          },
          {
            title: 'Nendoroid',
            link: '/nendoroid/:id'
          }
        ]
      },
      component: FormNendoroid
    },
    {
      path: '/nendoroid/:id/addpart',
      name: 'Add part to nendoroid',
      meta: {
        description: 'Add a part to a nendoroid',
        breadcrumb: [
          {
            title: 'Nendoroids',
            link: '/nendoroids'
          },
          {
            title: 'Nendoroid',
            link: '/nendoroid/:id'
          }
        ],
        frompart: 'nendoroid'
      },
      component: AddPart
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
      path: '/photo/add',
      name: 'Add Photo',
      meta: {
        description: 'Add a photo',
        breadcrumb: [
          {
            title: 'Photos',
            link: '/photos'
          }
        ]
      },
      component: FormPhoto
    },
    {
      path: '/photo/:id/addpart',
      name: 'Photo add part',
      meta: {
        description: 'Add a part to a photo',
        breadcrumb: [
          {
            title: 'Photos',
            link: '/photos'
          },
          {
            title: 'Photo',
            link: '/photo/:id'
          }
        ]
      },
      component: FormPhotoPart
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
    },
    {
      path: '/search',
      name: 'Search',
      meta: {
        description: 'Search in Nendoroids db'
      },
      component: Search
    },
    {
      path: '/news',
      name: 'News',
      meta: {
        description: 'News of Nendoroids db'
      },
      component: News
    },
    {
      path: '/news/add',
      name: 'Add news',
      meta: {
        description: 'Add a single news',
        breadcrumb: [
          {
            title: 'News',
            link: '/news'
          }
        ]
      },
      component: FormSingleNews
    },
    {
      path: '/news/:id/edit',
      name: 'Edit news',
      meta: {
        description: 'Edit a single news',
        breadcrumb: [
          {
            title: 'News',
            link: '/news'
          },
          {
            title: 'Single news',
            link: '/news/:id'
          }
        ]
      },
      component: FormSingleNews
    },
    {
      path: '/news/:id',
      name: 'Single News',
      meta: {
        description: 'A single news',
        breadcrumb: [
          {
            title: 'News',
            link: '/news'
          }
        ]
      },
      component: SingleNews
    },
    {
      path: '/users',
      name: 'Users',
      meta: {
        description: `Users`,
        breadcrumb: [
        ]
      },
      component: Users
    },
    {
      path: '/user/:id/favorites',
      name: 'User Favorites',
      meta: {
        description: `User's favorites`,
        breadcrumb: [
          {
            title: 'Users',
            link: '/users'
          },
          {
            title: 'User',
            link: '/user/:id'
          }
        ]
      },
      component: UserFavorites
    },
    {
      path: '/user/:id/collection',
      name: 'User Collection',
      meta: {
        description: `User's collection`,
        breadcrumb: [
          {
            title: 'Users',
            link: '/users'
          },
          {
            title: 'User',
            link: '/user/:id'
          }
        ]
      },
      component: UserCollection
    },
    {
      path: '/user/:id/photos',
      name: 'User Photos',
      meta: {
        description: `User's photos`,
        breadcrumb: [
          {
            title: 'Users',
            link: '/users'
          },
          {
            title: 'User',
            link: '/user/:id'
          }
        ]
      },
      component: UserPhotos
    },
    {
      path: '/user/:id/edit/image',
      name: 'Edit user photo',
      meta: {
        description: 'Edit the photo of an user',
        breadcrumb: [
          {
            title: 'Users',
            link: '/users'
          },
          {
            title: 'User',
            link: '/user/:id'
          }
        ]
      },
      component: FormImage
    },
    {
      path: '/user/:id/edit',
      name: 'Edit User',
      meta: {
        description: `Edit a user`,
        breadcrumb: [
          {
            title: 'Users',
            link: '/users'
          },
          {
            title: 'User',
            link: '/user/:id'
          }
        ]
      },
      component: FormUser
    },
    {
      path: '/user/:id',
      name: 'Single User',
      meta: {
        description: 'A single user',
        breadcrumb: [
          {
            title: 'Users',
            link: '/users'
          }
        ]
      },
      component: User
    },
    {
      path: '/about',
      name: 'About',
      meta: {
        description: 'About Nendoroids-db'
      },
      component: About
    }
  ]
})
