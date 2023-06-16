import { ApiService } from '@/plugins/Axios'
import { ApiEnum } from '@/utils/ApiEnum'

//GỌI API LIÊN QUAN USER chung là sao chung riêng gì á
class User {
  async list() {
    try {
      const data: ApiSuccess = await ApiService.instance().axios.get(ApiEnum.USER_LIST)
      if (data && data.status && data.code === 0) {
        return data.data
      }
    } catch (e) {
      return e
    }
  }
}

export const UserService = new User()