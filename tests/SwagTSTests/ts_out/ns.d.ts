declare module TestClasses {
  export interface SimpleClass {
    int_prop: number;

    float_prop: number;

    string_prop: string;

    bool_prop: boolean;

    cls_prop: SubClass;

    comment_prop: number; // comment

    /*
     * comment
     * multiline
     */
    ml_comment_prop: number;

    untyped_array: Array;

    str_array: string[];

    cls_array: SubClass[];

  }

  export interface SubClass {
  }

}