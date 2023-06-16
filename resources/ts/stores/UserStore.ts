import { defineStore } from 'pinia'
import { UserService } from '@/services/UserService'
import { UserEntity } from '@/@types/UserEntity'

interface UserStoreState {
  users: Array<UserEntity>
}

interface UserStoreActions {
  getList(): Promise<void>
}

interface UserStoreGetters {
  user: object
}

export interface UserStore extends UserStoreActions, UserStoreGetters, UserStoreState {
}

export const useUserStore = defineStore('user', {
  state: (): UserStoreState => ({
    users: [],
  }),
  actions: {
    async getList() {
      const data = await UserService.list()
      console.log(data)
    },
  },
  getters: {
    user() {
      return {
        name: 'name',
      }
    },
  },
})