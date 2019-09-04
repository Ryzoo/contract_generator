
import { ConditionalEnum } from "./Enums";

class ConditionalParser{
    setStore(store){
        this.store = store;
    }

    validate( conditionalType, attribute ){
        return attribute.conditionals
            .every(c => c.conditionalType != conditionalType || this.isConditionalValidAndEqual(c.content, true))
    }

    isConditionalValidAndEqual(content, equalValue){
        console.log("Now I parse", content);

        if(!this.store.getters.formAttributes){
            return !equalValue;
        }

        return this.parseConditionalStringToBool( content) === equalValue;
    }

    parseConditionalStringToBool(content){
        const contentWithVariables = content.map( e => {

            if(e.length >= 3 && e[0] === "{" && e[e.length-1] === "}"){
                const varId = parseInt(e.slice(1,e.length-1));
                return this.getVariableValue(varId);
            }

            return e;
        });

        console.log("Parsing for", contentWithVariables.join(" "), " is ",eval(contentWithVariables.join(" ")));

        return eval(contentWithVariables.join(" "));
    }

    getVariableValue(varId){
        const allAttributes = this.store.getters.formAttributes;
        const findedAttribute = allAttributes.find(e => e.id == varId);

        if(!findedAttribute){
            console.error(`Var: ${varId} not found`);
            return null;
        }

        return findedAttribute.value;
    }
}

export default new ConditionalParser();
