export default {}

declare global {
  interface ApiSuccess {
    code: number
    data: Array<any>
    message: string
    status: boolean
  }

  interface ApiError {
    code: number
    errrors: Array<any>
    message: string
    status: boolean
  }

  interface Pagination {
    page: string | number
    pages: string | number
    total: string | number
    perpage: string | number
  }
}