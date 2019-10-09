import {ConditionalEnum, FormElementsEnum} from "../../additionalModules/Enums";

const defaultState = {
    formElements: []
};

const actions = {
    formElements_set: (context, data) => {
        context.commit('SET_ELEMENTS', data);
        context.commit("RECALCULATE_CONDITIONS");
    },
    formElements_change: (context, data) => {
        context.commit('CHANGE_ELEMENT', data.element);
        context.commit("RECALCULATE_CONDITIONS");
    }
};

const mutations = {
    SET_ELEMENTS: (state, data) => {
        state.formElements = data.map((e, index) => {
            e.id = index;
            if(e.elementType === FormElementsEnum.ATTRIBUTE){
                e.attribute.value = e.attribute.defaultValue;
                console.log(e.isValid);
            }
            return e;
        });
    },
    CHANGE_ELEMENT: (state, data) => {
        state.formElements = state.formElements.map(e => {
            return e.id === data.id ? data : e;
        });
    },
    RECALCULATE_CONDITIONS: (state) => {
        state.formElements = state.formElements.map(e => {
            if(e.elementType === FormElementsEnum.ATTRIBUTE){
                e.isActive = ConditionalParser.validate(ConditionalEnum.SHOW_ON, e)
            }
            return e;
        });
    },
};

const getters = {
    formElements: state => state.formElements,
    formElementsStepList: state => {
        let currentIndex = 0;
        let listToReturn = [{
            id: 1,
            completed: false,
            content: []
        }];

        state.formElements.map(e => {
            switch (e.elementType) {
                case FormElementsEnum.PAGE_BRAKE:
                    currentIndex++;
                    listToReturn.push({
                        id: 1 + currentIndex,
                        completed: false,
                        content: []
                    });
                    break;
                default:
                    listToReturn[currentIndex].content.push(e);
            }
        });

        listToReturn = listToReturn.filter(x => x.content.length > 0);
        listToReturn = listToReturn.map((item, index) => {
            item.id = 1 + index;
            return item;
        });

        return listToReturn;
    }
};


export default {
    state: defaultState,
    getters,
    actions,
    mutations,
};
